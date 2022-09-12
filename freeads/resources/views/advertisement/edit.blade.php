@extends('layouts.app')

@section('title', 'Edit advertisement')

@section('content')
    <div class="container bg-white p-4">

        <h1>Edit advertisement</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="pl-4 m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" enctype="multipart/form-data" action="{{ route('advertisement.update', $ad->id) }}">
            @csrf
            @method('PUT')
            <label for="category_id" class="mt-2 mb-1">Category:</label>
            <select class="form-control col-sm-8" id="category_id" name="category_id">
                <option>Select category</option>
                @php
                    $category_id = old('category_id') ?? $ad->category_id;
                @endphp
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $category_id == $cat->id ? ' selected' : '' }}>
                        {{ $cat->title }}</option>
                @endforeach
            </select>

            <label for="product_name" class="mt-2 mb-1">Product-name:</label>
            <input type="text" class="form-control col-sm-2" id="product_name" name="product_name" cols="2">{{ old('product_name') }}</input>
           
            <label for="condition" class="mt-2 mb-1">Condition:</label>
            <input type="text" class="form-control col-sm-2" id="condition" name="condition" rows="4"
                cols="10">{{ old('condition') }}
            </input>

            <label for="pinCode" class="mt-2 mb-1">Pin Code:</label>
            <input type="number" class="form-control col-sm-2" id="pinCode" name="pinCode"
                value="{{ old('pinCode') ?? $ad->pinCode }}" />
            </input><br>

            <label for="description" class="mt-2 mb-1">Description:</label>
            <textarea class="form-control col-sm-8" id="description" name="description" rows="4"
                cols="50">{{ old('description') ?? $ad->description }}
            </textarea>

            <label for="image" class="mt-2 mb-1">Image:</label>
            <input type="file" class="form-control col-sm-8" id="image" name="image">
            </input>

            <label for="price" class="mt-2 mb-1">Price:</label>
            <input type="number" class="form-control col-sm-2" id="price" name="price" min="0.00" step="0.01"
                value="{{ old('price') ?? $ad->price }}" />
            </input><br>

            <input type="submit" class="btn btn-primary" value="Submit"></input>
        </form>
    </div>
@endsection