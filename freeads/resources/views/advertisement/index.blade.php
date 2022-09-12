@extends('layouts.app')

@section('title', 'Classifieds Board')

@section('content')
    <!--Working Code-->
    <div class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="display:block;">
        <h6>Sort by Categories</h6>
        <ul class="navbar-nav">
            <li class="nav-item  {{ Route::currentRouteName() == 'advertisement.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('advertisement.index') }}">All</a>
            </li>
            @php
                $category_id = $category->id ?? '';
            @endphp
            @foreach ($categories as $cat)
                <!--display categoriesin horizontal list -->
                <li class="nav-item {{ $category_id === $cat->id ? 'active' : '' }}">
                    <a class="nav-link" style="padding-left:30px;" href="{{ route('advertisement.adsByCategory', $cat->id) }}">{{ $cat->title }}</a>
                </li>
            @endforeach
        </ul>
    </div><br><br>
    <div class="fluid-container border border-primary" style="display:grid; grid-template-columns: auto auto; padding-top: 2vh;border-radius:10px">

        <div class="row mx-3">
            @foreach ($ads as $ad)
                <!--Product display-->
                <div class="col-3 p-0">
                    <div class="card m-2 p-0" style="background: blue;box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);backdrop-filter: blur(1.8px);-webkit-backdrop-filter: blur(1.8px);border: 1px solid rgba(118, 214, 242, 0.64);">
                        <a href="{{ route('advertisement.show', $ad->id) }}">
                            <img src="{{ $ad->image_url }}" class="card-img-top"></a>
                        <!--<p class="text-right text-muted p-2 m-0">{{ $ad->price }} &euro;</p>
                        <p class="text-left text-muted p-2 m-0">{{ $ad->product_name }}</p>-->
                        <div class="bg-light d-flex justify-content-between" style="padding:10px;">
                            <div style="text-transform: capitalize;"><h5>{{ $ad->product_name }}</h5></div>
                            <div >{{ $ad->price }} &euro;</div>
                        </div>
                        <div class="bg-light d-flex justify-content-between" style="padding:10px;">
                            <div style="text-transform: capitalize;">{{ $ad->condition }}</div>
                            <div style="text-transform: capitalize;">{{ $ad->category->title }}</div>
                        </div>
                    </div>
                    
                </div>
            @endforeach
        </div>

       
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $ads->links() }}
    </div>

@endsection
