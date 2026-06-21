@extends('layouts.customer')

@section('title', 'AkieRepair Enterprise')

@section('content')

{{-- HERO --}}
<section class="hero">
    <div>
        <h1>
            Electronic Device & Appliance
            <em>Repair Service</em>
        </h1>

        <p>
            Professional repair service for smartphones, televisions,
            washing machines, and refrigerators with real-time repair tracking.
        </p>

        <br><br>

        <a href="{{ route('customer.services') }}" class="btn blue">
            Explore Services
        </a>

        <a href="{{ route('customer.devices') }}" class="btn">
            View Devices
        </a>
    </div>
</section>

{{-- INTRO --}}
<section class="section">
    <div class="container center">

        <span class="badge">AKIEREPAIR ENTERPRISE</span>

        <h2 class="title">
            Trusted Repair Service For Your Devices
        </h2>

        <p class="lead">
            AkieRepair Enterprise provides professional repair services
            for electronic devices and home appliances with transparent
            repair progress updates and technician assignment.
        </p>

    </div>
</section>

{{-- SERVICES PREVIEW --}}
<section class="section light">
    <div class="container">

        <div class="center">
            <span class="badge">OUR SERVICES</span>

            <h2 class="title">
                Main Repair Categories
            </h2>

            <p class="lead">
                Browse our main repair categories before selecting
                detailed repair types during booking.
            </p>
        </div>

        <br><br>

        <div class="grid grid-4">

            {{-- PHONE --}}
            <div class="room-card">

                <img
                    class="room-img"
                    src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=900&q=80"
                >

                <div class="body">

                    <span class="badge">Phone Repair</span>

                    <h3>Smartphone Repair</h3>

                    <p>
                        Screen replacement, battery replacement,
                        charging issues, motherboard repair and more.
                    </p>

                    <br>

                    <a href="{{ route('customer.booking.create') }}"
                       class="btn blue">
                        Book Repair
                    </a>

                </div>
            </div>

            {{-- TV --}}
            <div class="room-card">

                <img
                    class="room-img"
                    src="https://images.unsplash.com/photo-1593784991095-a205069470b6?auto=format&fit=crop&w=900&q=80"
                >

                <div class="body">

                    <span class="badge">TV Repair</span>

                    <h3>Television Repair</h3>

                    <p>
                        LED TV, Smart TV, audio problems,
                        display repair and power issues.
                    </p>

                    <br>

                    <a href="{{ route('customer.booking.create') }}"
                       class="btn blue">
                        Book Repair
                    </a>

                </div>
            </div>

            {{-- WASHING MACHINE --}}
            <div class="room-card">

                <img
                    class="room-img"
                    src="https://images.unsplash.com/photo-1626806787461-102c1bfaaea1?auto=format&fit=crop&w=900&q=80"
                >

                <div class="body">

                    <span class="badge">Appliance Repair</span>

                    <h3>Washing Machine Repair</h3>

                    <p>
                        Washing machine maintenance,
                        motor repair, water leakage and more.
                    </p>

                    <br>

                    <a href="{{ route('customer.booking.create') }}"
                       class="btn blue">
                        Book Repair
                    </a>

                </div>
            </div>

            {{-- FRIDGE --}}
            <div class="room-card">

                <img
                    class="room-img"
                    src="https://images.unsplash.com/photo-1584568694244-14fbdf83bd30?auto=format&fit=crop&w=900&q=80"
                >

                <div class="body">

                    <span class="badge">Fridge Repair</span>

                    <h3>Refrigerator Repair</h3>

                    <p>
                        Cooling system repair,
                        gas refill, compressor issues and more.
                    </p>

                    <br>

                    <a href="{{ route('customer.booking.create') }}"
                       class="btn blue">
                        Book Repair
                    </a>

                </div>
            </div>

        </div>

    </div>
</section>

{{-- FEATURES --}}
<section class="section">
    <div class="container">

        <div class="center">
            <span class="badge">SYSTEM FEATURES</span>

            <h2 class="title">
                Why Choose AkieRepair
            </h2>
        </div>

        <br><br>

        <div class="grid grid-3">

            <div class="panel">
                <h3>Online Booking</h3>

                <p>
                    Customers can easily create repair bookings
                    without manually contacting admin through WhatsApp.
                </p>
            </div>

            <div class="panel">
                <h3>Repair Tracking</h3>

                <p>
                    Track repair progress in real-time
                    similar to order tracking systems.
                </p>
            </div>

            <div class="panel">
                <h3>Technician Assignment</h3>

                <p>
                    Admin can assign technicians
                    based on expertise and availability.
                </p>
            </div>

        </div>

    </div>
</section>

{{-- CTA --}}
<section class="section light">
    <div class="container center">

        <span class="badge">READY TO BOOK?</span>

        <h2 class="title">
            Start Your Repair Booking Today
        </h2>

        <p class="lead">
            Login or create an account to book your repair service
            and track repair progress online.
        </p>

        <br><br>

        @guest
            <a href="{{ route('login') }}" class="btn blue">
                Login / Sign Up
            </a>
        @endguest

        @auth
            <a href="{{ route('customer.booking.create') }}"
               class="btn blue">
                Create Booking
            </a>
        @endauth

    </div>
</section>

@endsection