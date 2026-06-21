@extends('layouts.customer')

@section('title', 'Services')

@section('content')

<section class="hero small">
    <div>
        <h1>Repair <em>Services</em></h1>

        <p>
            Browse available repair services provided by AkieRepair Enterprise.
        </p>
    </div>
</section>

<section class="section light">

    <div class="container">

        <div class="service-grid">

            @forelse($services as $service)

                <div class="service-card">

                    @php
                        $image = '';

                        if($service->service_type == 'Phone Repair'){
                            $image = 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=1200&auto=format&fit=crop';
                        }

                        elseif($service->service_type == 'TV Repair'){
                            $image = 'https://images.unsplash.com/photo-1593784991095-a205069470b6?q=80&w=1200&auto=format&fit=crop';
                        }

                        elseif($service->service_type == 'Washing Machine Repair'){
                            $image = 'https://images.unsplash.com/photo-1626806787461-102c1bfaaea1?q=80&w=1200&auto=format&fit=crop';
                        }

                        else{
                            $image = 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?q=80&w=1200&auto=format&fit=crop';
                        }
                    @endphp

                    <img src="{{ $image }}" alt="{{ $service->service_type }}">

                    <div class="service-content">

                        <span class="badge">
                            SERVICE
                        </span>

                        <h3>
                            {{ $service->service_type }}
                        </h3>

                        <p>
                            Professional repair service for
                            {{ strtolower($service->service_type) }}.
                        </p>

                        <a href="{{ route('customer.repairs', $service->id) }}"
                           class="btn pink">
                            VIEW REPAIRS
                        </a>

                    </div>

                </div>

            @empty

                <p>No services available.</p>

            @endforelse

        </div>

    </div>

</section>

<style>

.service-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:40px;
}

.service-card{
    background:white;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.service-card img{
    width:100%;
    height:280px;
    object-fit:cover;
}

.service-content{
    padding:35px;
}

.service-content h3{
    font-size:52px;
    margin:15px 0;
    line-height:1.1;
}

.service-content p{
    color:#667085;
    margin-bottom:30px;
}

.pink{
    background:#e91e63;
}

.pink:hover{
    background:#c2185b;
}

</style>

@endsection