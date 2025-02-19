{{-- Page view list apartment of admin --}}

@extends('layouts.guests')

@section('content')
<div class="section" id="your-apartments">
    <div class="container">
        <h1 class="pl-3 title-pers pt-3">Your Apartments:</h1>
        @if (count($apartments) == 0)
        <p class="pl-3 pt-3">There are no apartments to show</p> 
        @endif

        {{-- Call to apartment's table and stamp apartment list of admin --}}
        @foreach ($apartments as $apartment)

            <div id="admin-index" class="container-fluid">

                <div class="row border-bottom">

                    <?php
                        $image = $apartment->cover_image;
                        $pos = strpos($image, "http");          
                    ?> 

                    {{-- Cover Apartment --}}
                    <?php if ($pos === false) {?>
                    <div class="col-12 col-md-2 p-3 d-flex rounded-personalized mt-4" style="background-image: url({{asset('storage/'.$apartment->cover_image)}})"></div>
                    <?php } else {?>
                    <div class="col-12 col-md-2 p-3 d-flex rounded-personalized mt-4" style="background-image: url({{$apartment->cover_image}})"></div>    
                    <?php }?>
                    
                   
                    {{-- Description Apartments --}}
                    <div class="col-12 col-md-10">

                        {{-- Description --}}
                        <div class="card-body">
                            <h5 class="card-title">{{$apartment->title}}</h5>
                            
                            <p class="card-text">{{$apartment->description}}</p>
                            
                            <p class="card-text"><small class="text-muted">Created on {{$apartment->created_at->format('d-m-Y')}}.</small></p>
                        </div>
                        {{-- {{-- bottom for link pages --}}
                        <div class="d-flex flex-wrap link-personalized mb-1">
                            @if (count($apartment->sponsorizations->where('end_date', '>', date('Y-m-d h:i:s'))) == 1)
                            <span class="sponsored mr-3">Sponsored</span>
                            @endif
                            <span class="line-height mr-1">{{count($apartment->messages)}}</span><span class="d-flex justify-content-center align-items-center mr-3"><i class="far fa-envelope"></i></span>
                            <a href="{{route('admin.apartment.show', $apartment)}}" class="btn-personalized btn mr-2 mb-2">Show</a>
                            <a href="{{route('admin.apartment.edit', $apartment)}}" class="btn-personalized btn mr-2 mb-2">Edit</a>
                            <a href="{{route('admin.statistics',$apartment->id)}}" class="btn-personalized btn mr-2 mb-2">Statistics</a>
                            <a href="{{route('admin.sponsorization.create', ["id"=>$apartment->id])}}" class="btn-personalized btn mr-2 mb-2">Sponsorization</a>
                        </div>

                    </div>
                </div>

            </div>

        @endforeach


    </div>
</div>
    
@endsection
