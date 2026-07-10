@extends('layouts.customer')

@section('title', 'Rate Repair Service')

@section('content')

@php
    $finishedImage = optional($booking->timelines->first(function ($timeline) {
        return $timeline->title === 'Repair Finished' && ! empty($timeline->image);
    }))->image;
@endphp

<style>
    .review-shell {
        max-width: 920px;
        margin: 0 auto;
    }

    .review-card {
        display: grid;
        grid-template-columns: minmax(260px, .9fr) minmax(0, 1.1fr);
        gap: 0;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        box-shadow: 0 16px 45px rgba(15, 23, 42, .08);
    }

    .review-photo {
        min-height: 520px;
        background: linear-gradient(135deg, #dbeafe, #ecfdf5);
    }

    .review-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .review-photo-empty {
        height: 100%;
        display: grid;
        place-items: center;
        color: #2563eb;
        font-size: 4rem;
    }

    .review-body {
        padding: 34px;
    }

    .review-kicker {
        color: #16a34a;
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .review-body h1 {
        margin: 10px 0 10px;
        color: #111827;
        font-size: 2rem;
        line-height: 1.15;
    }

    .review-body p {
        margin: 0 0 24px;
        color: #64748b;
        line-height: 1.7;
    }

    .review-summary {
        display: grid;
        gap: 10px;
        margin-bottom: 24px;
        padding: 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
    }

    .review-summary span {
        display: flex;
        justify-content: space-between;
        gap: 18px;
        color: #475569;
        font-size: .95rem;
    }

    .review-summary strong {
        color: #0f172a;
        text-align: right;
    }

    .rating-picker {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 6px;
        margin: 8px 0 22px;
    }

    .rating-picker input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .rating-picker label {
        color: #cbd5e1;
        font-size: 2.1rem;
        cursor: pointer;
        transition: color .16s ease, transform .16s ease;
    }

    .rating-picker label:hover,
    .rating-picker label:hover ~ label,
    .rating-picker input:checked ~ label {
        color: #f59e0b;
    }

    .rating-picker label:hover {
        transform: translateY(-2px);
    }

    .review-label {
        display: block;
        margin-bottom: 8px;
        color: #334155;
        font-weight: 800;
    }

    .review-textarea {
        width: 100%;
        min-height: 150px;
        padding: 14px 16px;
        resize: vertical;
    }

    .review-actions {
        display: flex;
        gap: 12px;
        margin-top: 22px;
        flex-wrap: wrap;
    }

    .review-submit,
    .review-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 46px;
        padding: 0 20px;
        border-radius: 10px;
        font-weight: 800;
        text-decoration: none;
        border: 0;
        cursor: pointer;
    }

    .review-submit {
        color: #06130c;
        background: linear-gradient(135deg, #86efac, #22c55e);
    }

    .review-back {
        color: #475569;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
    }

    .field-error {
        color: #dc2626;
        font-size: .85rem;
        margin-top: 6px;
    }

    @media(max-width: 820px) {
        .review-card {
            grid-template-columns: 1fr;
        }

        .review-photo {
            min-height: 260px;
        }
    }
</style>

<div class="review-shell">
    <div class="review-card">
        <div class="review-photo">
            @if($finishedImage)
                <img src="{{ asset($finishedImage) }}" alt="Finished repair proof for booking #{{ $booking->id }}">
            @else
                <div class="review-photo-empty"><i class="bi bi-tools"></i></div>
            @endif
        </div>

        <div class="review-body">
            <span class="review-kicker">Repair completed</span>
            <h1>How was your repair service?</h1>
            <p>Your rating and comment may be shown on the public homepage with the finished repair photo.</p>

            <div class="review-summary">
                <span>Booking <strong>#{{ $booking->id }}</strong></span>
                <span>Device <strong>{{ $booking->device->name ?? '-' }} {{ $booking->device->brand ?? '' }}</strong></span>
                <span>Technician <strong>{{ $booking->technician->name ?? '-' }}</strong></span>
            </div>

            <form method="POST" action="{{ route('customer.review.store', $booking->id) }}">
                @csrf

                <label class="review-label">Service Rating</label>
                <div class="rating-picker" aria-label="Service rating">
                    @for($rating = 5; $rating >= 1; $rating--)
                        <input type="radio" id="rating{{ $rating }}" name="rating" value="{{ $rating }}" {{ (int) old('rating', 5) === $rating ? 'checked' : '' }}>
                        <label for="rating{{ $rating }}" title="{{ $rating }} star{{ $rating > 1 ? 's' : '' }}"><i class="bi bi-star-fill"></i></label>
                    @endfor
                </div>
                @error('rating')<div class="field-error">{{ $message }}</div>@enderror

                <label for="comment" class="review-label">Comment</label>
                <textarea id="comment" name="comment" class="review-textarea" placeholder="Share your experience with the repair service..." required>{{ old('comment') }}</textarea>
                @error('comment')<div class="field-error">{{ $message }}</div>@enderror

                <div class="review-actions">
                    <button type="submit" class="review-submit">
                        <i class="bi bi-send-fill"></i> Submit Review
                    </button>
                    <a href="{{ route('customer.booking.history') }}" class="review-back">
                        <i class="bi bi-clock-history"></i> Later
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
