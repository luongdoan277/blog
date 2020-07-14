@extends('layour')

@section('main')
    <div class="gallery-upload">
        <h2>Upload</h2>
        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="price" placeholder="Price">
            <input type="file" name="image">
            <button type="submit" name="submit">Upload</button>
        </form>
    </div>
@endsection
