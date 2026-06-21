@extends('layouts.customer')

@section('title', 'Devices')

@section('content')

<section class="hero small">
    <div>
        <h1>Device <em>Blog</em></h1>
        <p>Choose your device category, select the model, then book repair.</p>
    </div>
</section>

<section class="section light">
    <div class="container">

        {{-- SMARTPHONE --}}
        <div class="blog-card">
            <img class="blog-img" src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=1200&q=80">

            <div class="body">
                <span class="badge">Smartphone</span>
                <h3>Smartphone Devices</h3>
                <p>Choose your smartphone model first, then book the repair service.</p>

                <button class="btn" onclick="toggleModels('smartphoneModels')">
                    Choose Smartphone Model
                </button>

                <div id="smartphoneModels" class="model-box">
                    <div class="model-list">
                        @forelse($smartphones as $device)
                            <div class="model-card">
                                <h4>{{ $device->name }}</h4>
                                <p>{{ $device->smartphone->operating_system }} smartphone with {{ $device->smartphone->storage }} storage.</p>

                                @auth
                                    <a href="{{ route('customer.booking.create', ['device_id' => $device->id]) }}" class="btn small">Book Repair</a>
                                @endauth

                                @guest
                                    <a href="{{ route('login') }}" class="btn small">Book Repair</a>
                                @endguest
                            </div>
                        @empty
                            <p>No smartphone devices available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- TELEVISION --}}
        <div class="blog-card" style="margin-top:30px;">
            <img class="blog-img" src="https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?auto=format&fit=crop&w=1200&q=80">

            <div class="body">
                <span class="badge">Television</span>
                <h3>Television</h3>
                <p>Select a TV model before booking.</p>

                <button class="btn" onclick="toggleModels('tvModels')">
                    Choose TV Model
                </button>

                <div id="tvModels" class="model-box">
                    <div class="model-list">
                        @forelse($televisions as $device)
                            <div class="model-card">
                                <h4>{{ $device->name }}</h4>
                                <p>{{ $device->brand }} television device.</p>

                                @auth
                                    <a href="{{ route('customer.booking.create', ['device_id' => $device->id]) }}" class="btn small">Book Repair</a>
                                @endauth

                                @guest
                                    <a href="{{ route('login') }}" class="btn small">Book Repair</a>
                                @endguest
                            </div>
                        @empty
                            <p>No television devices available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- WASHING MACHINE --}}
        <div class="blog-card" style="margin-top:30px;">
            <img class="blog-img" src="https://images.unsplash.com/photo-1626806787461-102c1bfaaea1?auto=format&fit=crop&w=1200&q=80">

            <div class="body">
                <span class="badge">Washing Machine</span>
                <h3>Washing Machine</h3>
                <p>Select a washing machine model before booking.</p>

                <button class="btn" onclick="toggleModels('washerModels')">
                    Choose Washing Machine Model
                </button>

                <div id="washerModels" class="model-box">
                    <div class="model-list">
                        @forelse($washingMachines as $device)
                            <div class="model-card">
                                <h4>{{ $device->name }}</h4>
                                <p>{{ $device->brand }} washing machine device.</p>

                                @auth
                                    <a href="{{ route('customer.booking.create', ['device_id' => $device->id]) }}" class="btn small">Book Repair</a>
                                @endauth

                                @guest
                                    <a href="{{ route('login') }}" class="btn small">Book Repair</a>
                                @endguest
                            </div>
                        @empty
                            <p>No washing machine devices available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- REFRIGERATOR --}}
        <div class="blog-card" style="margin-top:30px;">
            <img class="blog-img" src="https://images.unsplash.com/photo-1571175443880-49e1d25b2bc5?auto=format&fit=crop&w=1200&q=80">

            <div class="body">
                <span class="badge">Refrigerator</span>
                <h3>Refrigerator</h3>
                <p>Select a refrigerator model before booking.</p>

                <button class="btn" onclick="toggleModels('fridgeModels')">
                    Choose Refrigerator Model
                </button>

                <div id="fridgeModels" class="model-box">
                    <div class="model-list">
                        @forelse($refrigerators as $device)
                            <div class="model-card">
                                <h4>{{ $device->name }}</h4>
                                <p>{{ $device->brand }} refrigerator device.</p>

                                @auth
                                    <a href="{{ route('customer.booking.create', ['device_id' => $device->id]) }}" class="btn small">Book Repair</a>
                                @endauth

                                @guest
                                    <a href="{{ route('login') }}" class="btn small">Book Repair</a>
                                @endguest
                            </div>
                        @empty
                            <p>No refrigerator devices available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    function toggleModels(id) {
        document.querySelectorAll('.model-box').forEach(function(box) {
            if (box.id !== id) {
                box.classList.remove('active');
            }
        });

        document.getElementById(id).classList.toggle('active');
    }
</script>

@endsection