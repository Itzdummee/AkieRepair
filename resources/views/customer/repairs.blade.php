@extends('layouts.customer')

@section('title', 'Repairs')

@section('content')
<section class="hero small">
    <div>
        <h1>{{ $service->service_type }} <em>Options</em></h1>
        <p>Select repair type for this service.</p>
    </div>
</section>

<section class="section light">
    <div class="container">

        <div class="grid grid-3">

            @forelse($repairs as $repair)
                <div class="room-card">
                    <div class="body">
                        <span class="badge">
                            {{ $repair->device->name ?? 'Device' }}
                        </span>

                        <h3>{{ $repair->repair_name }}</h3>

                        <p>{{ $repair->description }}</p>

                        <div class="price">
                            RM {{ number_format($repair->price, 2) }}
                        </div>

                        <p>
                            Warranty: {{ $repair->warranty_period ?? '-' }} <br>
                            Duration: {{ $repair->duration ?? '-' }}
                        </p>

                        <a href="{{ route('login') }}" class="btn blue">
                            Book This Repair
                        </a>
                    </div>
                </div>
            @empty
                <p>No repairs available for this service.</p>
            @endforelse

        </div>

    </div>
</section>
@endsection