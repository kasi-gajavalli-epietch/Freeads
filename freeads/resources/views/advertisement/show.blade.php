@extends('layouts.app')

@section('title', 'Advertisement: ' . $ad->id)

@section('content')

    <div class="container bg-white p-3">
        @auth
            @if (auth()->user()->id === $ad->user_id)
                <form class="text-right" method="post" action="{{ route('advertisement.destroy', $ad->id) }}">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-primary mr-2" href="{{ route('advertisement.edit', $ad->id) }}">Edit</a>
                    <button type="submit" class="btn btn-secondary">Delete</button>
                </form>
            @endif
        @endauth

        <div class="row">
            <img class="col-6" src="{{ $ad->image_url }}">

            <div class="col" style="text-transform: capitalize;">
                <!--<h5><b>Id: </b> {{ $ad->id }}</h5><br>-->
                <h5><b>Posted by: </b> {{ $user->name }}</h5><br>
                <h5><b>Category: </b> {{ $ad->category->title }}</h5><br>
                <h5><b>Price: </b> {{ $ad->price }} &euro;</h5><br>
                <h5><b>Product Name:</b><b> {{ $ad->product_name }}</h5><br>
                <h5><b>Condition:</b><b> {{ $ad->condition }}</h5><br>
               <!-- <h5><b>	pinCode:</b></h5>
                <p>{{ $ad->	pinCode }}</p>-->
                <h5><b>Description:</b><b> {{ $ad->description }}</h5><br>
                
            </div>
        </div>
    </div>
@endsection
