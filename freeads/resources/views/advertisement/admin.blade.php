@extends('layouts.app')

@section('title', 'My advertisements')

@section('content')

    <div class="row mx-3">
        @forelse ($ads as $ad)
            <div class="col-2 p-0">
                <div class="card m-2 p-0">
                    <a href="{{ route('advertisement.show', $ad->id) }}">
                        <img src="{{ $ad->image_url }}" class="card-img-top"></a>
                        <div class="bg-light d-flex justify-content-between" style="padding:10px;">
                            <div style="text-transform: capitalize;"><h5>{{ $ad->product_name }}</h5></div>
                            <div >{{ $ad->price }} &euro;</div>
                        </div>
                        <div class="bg-light d-flex justify-content-between" style="padding:10px;">
                            <div style="text-transform: capitalize;">{{ $ad->condition }}</div>
                            <div style="text-transform: capitalize;">{{ $ad->category->title }}</div>
                        </div>


                    <form class="text-center pb-2" method="post" action="{{ route('advertisement.destroy', $ad->id) }}">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-primary mr-2 py-0" href="{{ route('advertisement.edit', $ad->id) }}">Edit</a>
                        <button type="submit" class="btn btn-secondary py-0">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            You have no advertisements.
        @endforelse
        
    </div>

@endsection