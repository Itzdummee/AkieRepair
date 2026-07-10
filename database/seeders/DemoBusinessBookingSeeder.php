<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\BookingReview;
use App\Models\BookingTimeline;
use App\Models\Device;
use App\Models\Repair;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoBusinessBookingSeeder extends Seeder
{
    private const CUSTOMER_COUNT = 150;

    private const COMPLETED_REPAIR_IMAGES = [
        'https://images.unsplash.com/photo-1550041473-d296a3a8a18a?auto=format&fit=crop&w=1200&q=80',
        'https://images.pexels.com/photos/38190070/pexels-photo-38190070.jpeg?auto=compress&cs=tinysrgb&w=1200',
        'https://images.pexels.com/photos/37174867/pexels-photo-37174867.jpeg?auto=compress&cs=tinysrgb&w=1200',
    ];

    private const COMPLETED_REPAIR_COMMENTS = [
        'The repair was completed perfectly and my device is working like new again.',
        'Fast, professional service. The technician explained the repair clearly and tested everything before pickup.',
        'Very satisfied with the repair quality and the helpful progress updates.',
        'My device was returned in excellent condition. Friendly service and a smooth experience.',
        'The problem is fully resolved and the repair was completed within the promised time.',
    ];

    private array $technicianByType = [
        'Smartphone' => 'T001',
        'Television' => 'T002',
        'Refrigerator' => 'T003',
        'Washing Machine' => 'T004',
    ];

    public function run(): void
    {
        $customers = User::where('role', 'customer')
            ->whereIn('email', array_map(fn ($i) => "customer{$i}@gmail.com", range(1, self::CUSTOMER_COUNT)))
            ->orderBy('id')
            ->get();

        $devices = Device::with('repairs')->orderBy('type')->orderBy('id')->get();
        $technicians = User::whereIn('id', array_values($this->technicianByType))->get()->keyBy('id');

        if ($customers->count() < self::CUSTOMER_COUNT || $devices->isEmpty() || $technicians->count() < 4) {
            $this->command?->warn('Demo business booking seeder skipped. Run customer, technician, device, and repair seeders first.');
            return;
        }

        $customerIds = $customers->pluck('id');

        DB::transaction(function () use ($customers, $devices, $customerIds) {
            $bookingIds = Booking::whereIn('customer_id', $customerIds)->pluck('id');
            BookingTimeline::whereIn('booking_id', $bookingIds)->delete();
            Booking::whereIn('id', $bookingIds)->delete();

            Model::unguarded(function () use ($customers, $devices) {
                BookingTimeline::withoutEvents(function () use ($customers, $devices) {
                    foreach ($customers->values() as $index => $customer) {
                        $bookingNo = $index + 1;
                        $device = $devices[$index % $devices->count()];
                        $repair = $this->pickRepair($device, $bookingNo);
                        $status = $this->statusFor($bookingNo);
                        $dates = $this->datesFor($bookingNo, $status);
                        $technicianId = $this->technicianByType[$device->type] ?? null;
                        $quotePrice = $this->quotePrice($repair, $bookingNo);
                        $quotationStatus = $this->quotationStatusFor($status);
                        $paymentStatus = $status === 'Repair Completed' ? 'Paid' : 'Pending';

                        $booking = Booking::create([
                            'customer_id' => $customer->id,
                            'device_id' => $device->id,
                            'repair_id' => $repair?->id,
                            'technician_id' => $technicianId,
                            'problem_description' => $this->problemDescription($device, $repair, $bookingNo),
                            'visit_date' => $dates['visit'],
                            'inspection_report' => $this->inspectionReport($repair, $device),
                            'quotation_price' => $quotePrice,
                            'quotation_note' => $this->quotationNote($status, $device),
                            'quotation_status' => $quotationStatus,
                            'pickup_date' => $dates['pickup'],
                            'repair_finished_date' => $dates['finished'],
                            'status' => $status,
                            'payment_status' => $paymentStatus,
                            'amount_paid' => $paymentStatus === 'Paid' ? $quotePrice : null,
                            'payment_date' => $dates['payment'],
                            'created_at' => $dates['created'],
                            'updated_at' => $dates['updated'],
                        ]);

                        $this->createTimeline($booking, $status, $dates, $quotePrice);

                        if ($status === 'Repair Completed') {
                            $this->createReview($booking, $bookingNo, $dates['payment']);
                        }
                    }
                });
            });
        });

        $this->command?->info('150 demo bookings seeded: 50 completed, 50 rejected, and 50 ongoing repairs.');
    }

    private function statusFor(int $bookingNo): string
    {
        return match ($bookingNo % 3) {
            1 => 'Repair Completed',
            2 => 'Quotation Rejected',
            default => 'Repair In Progress',
        };
    }

    private function datesFor(int $bookingNo, string $status): array
    {
        $start = Carbon::create(now()->year, 1, 3)->startOfDay();
        $created = $this->bookingDateFor($bookingNo, $start);
        $visit = $created->copy()->addDays(($bookingNo % 4) + 1);
        $inspection = $visit->copy()->addDay();
        $quotation = $inspection->copy()->addDay();
        $accepted = $quotation->copy()->addDays(($bookingNo % 3) + 1);
        $isLate = in_array($bookingNo % 10, [0, 7], true);
        $repairDays = $isLate ? 14 + ($bookingNo % 5) : 2 + ($bookingNo % 5);
        $finished = $accepted->copy()->addDays($repairDays);
        $payment = $finished->copy()->addDays(($bookingNo % 4) + 1);
        $rejectedAt = $quotation->copy()->addDays(($bookingNo % 3) + 1);

        return [
            'created' => $created,
            'visit' => $visit->toDateString(),
            'inspection' => $inspection,
            'quotation' => $quotation,
            'accepted' => $accepted,
            'rejected' => $rejectedAt,
            'finished' => $status === 'Repair Completed' ? $finished->toDateString() : null,
            'pickup' => $status === 'Repair Completed' ? $payment->copy()->addDay()->toDateString() : null,
            'payment' => $status === 'Repair Completed' ? $payment : null,
            'updated' => match ($status) {
                'Quotation Rejected' => $rejectedAt,
                'Repair In Progress' => $accepted->copy()->addHours(4),
                default => $payment,
            },
            'is_late' => $isLate,
        ];
    }

    private function bookingDateFor(int $bookingNo, Carbon $start): Carbon
    {
        $monthPlan = [
            ['month' => 1, 'count' => 20],
            ['month' => 2, 'count' => 25],
            ['month' => 3, 'count' => 30],
            ['month' => 4, 'count' => 25],
            ['month' => 5, 'count' => 20],
            ['month' => 6, 'count' => 20],
            ['month' => 7, 'count' => 10],
        ];

        $position = $bookingNo;
        foreach ($monthPlan as $plan) {
            if ($position <= $plan['count']) {
                return $start->copy()
                    ->month($plan['month'])
                    ->day(2)
                    ->addDays(($position - 1) % 24)
                    ->addHours(($bookingNo % 8) + 8);
            }

            $position -= $plan['count'];
        }

        return $start->copy()->addDays($bookingNo - 1);
    }

    private function pickRepair(Device $device, int $bookingNo): ?Repair
    {
        $repairs = $device->repairs;

        if ($repairs->isEmpty()) {
            return Repair::where('device_id', $device->id)->first();
        }

        return $repairs->values()[($bookingNo - 1) % $repairs->count()];
    }

    private function quotePrice(?Repair $repair, int $bookingNo): float
    {
        $base = (float) ($repair?->price ?? 120);
        $inspectionFee = [0, 20, 35, 50][$bookingNo % 4];

        return round($base + $inspectionFee, 2);
    }

    private function quotationStatusFor(string $status): ?string
    {
        return $status === 'Quotation Rejected' ? 'Rejected' : 'Accepted';
    }

    private function problemDescription(Device $device, ?Repair $repair, int $bookingNo): string
    {
        $symptoms = [
            'Smartphone' => ['screen flickers after a drop', 'battery drains too quickly', 'charging port is loose', 'back glass is cracked'],
            'Television' => ['power light blinks but screen stays black', 'display has no picture', 'HDMI ports stopped working'],
            'Refrigerator' => ['not cooling consistently', 'control panel shows error code', 'compressor cycles too often'],
            'Washing Machine' => ['cycle stops halfway', 'machine will not spin', 'control board does not respond'],
        ];

        $typeSymptoms = $symptoms[$device->type] ?? ['needs repair'];
        $symptom = $typeSymptoms[$bookingNo % count($typeSymptoms)];

        return "Customer reported {$symptom} on {$device->brand} {$device->name}. Requested " . strtolower($repair?->repair_type ?? 'diagnosis') . '.';
    }

    private function inspectionReport(?Repair $repair, Device $device): string
    {
        if (! $repair) {
            return 'Uncovered problem remark: Technician inspection found a device fault that requires manual quotation.';
        }

        return 'Covered repair(s): ' . $repair->repair_type
            . "\nUncovered problem remark: Diagnostic check completed for {$device->brand} {$device->name}.";
    }

    private function quotationNote(string $status, Device $device): ?string
    {
        return "Quotation includes parts, labour, and testing for {$device->brand} {$device->name}.";
    }

    private function createTimeline(Booking $booking, string $status, array $dates, float $quotePrice): void
    {
        $events = [
            ['Visit Requested', 'Customer submitted a repair booking request.', $dates['created']],
            ['Technician Assigned', 'Admin assigned the correct specialist technician for this device type.', Carbon::parse($dates['visit'])->subDay()],
        ];

        $events[] = ['Inspection Completed', 'Technician completed diagnosis and submitted repair findings.', $dates['inspection']];
        $events[] = ['Quotation Sent', 'Admin sent quotation for RM ' . number_format($quotePrice, 2) . '.', $dates['quotation']];

        if ($status === 'Quotation Rejected') {
            $events[] = ['Quotation Rejected', 'Customer rejected the quotation after review. Repair work was not started.', $dates['rejected']];
            $this->insertTimelineEvents($booking, $events);
            return;
        }

        $events[] = ['Quotation Accepted', 'Customer accepted the quotation.', $dates['accepted']];
        $events[] = ['Repair In Progress', 'Technician started repair work after customer approval.', $dates['accepted']->copy()->addHours(4)];

        if ($status === 'Repair In Progress') {
            $this->insertTimelineEvents($booking, $events);
            return;
        }

        $finishDescription = $dates['is_late']
            ? 'Technician finished the repair later than expected due to parts delay.'
            : 'Technician finished the repair work and completed quality checks.';

        $events[] = [
            'Repair Finished',
            $finishDescription . ' Finished on ' . Carbon::parse($dates['finished'])->format('d M Y') . '.',
            Carbon::parse($dates['finished']),
            self::COMPLETED_REPAIR_IMAGES[($booking->id - 1) % count(self::COMPLETED_REPAIR_IMAGES)],
        ];

        $events[] = ['Payment Completed', 'Customer completed payment. Repair service is closed.', $dates['payment']];
        $events[] = ['Repair Completed', 'Booking completed and archived as a paid repair.', $dates['payment']->copy()->addHour()];

        $this->insertTimelineEvents($booking, $events);
    }

    private function insertTimelineEvents(Booking $booking, array $events): void
    {
        foreach ($events as $event) {
            [$title, $description, $date] = $event;

            BookingTimeline::create([
                'booking_id' => $booking->id,
                'title' => $title,
                'description' => $description,
                'status' => 'Completed',
                'image' => $event[3] ?? null,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }

    private function createReview(Booking $booking, int $bookingNo, Carbon $paymentDate): void
    {
        BookingReview::create([
            'booking_id' => $booking->id,
            'customer_id' => $booking->customer_id,
            'rating' => 4 + ($bookingNo % 2),
            'comment' => self::COMPLETED_REPAIR_COMMENTS[($bookingNo - 1) % count(self::COMPLETED_REPAIR_COMMENTS)],
            'created_at' => $paymentDate->copy()->addHours(2),
            'updated_at' => $paymentDate->copy()->addHours(2),
        ]);
    }
}
