@extends('welcome')

@section('main')
    <div class="gallery-upload">
        <h2>Edit</h2>
        <form action="{{route('edit', $product->id)}}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <input type="text" name="name" value={{$product->name}}>
            <input type="text" name="price" value={{$product->price}}>
            <input type="file" name="image">
            <button type="submit" name="submit">Save</button>
        </form>
    </div>

@endsection
