@extends('welcome')

@section('main')
    <div class="gallery-upload">
        <h2>Upload</h2>
        <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="filename" placeholder="Name">
            <input type="text" name="titleGallery" placeholder="Title">
            <input type="text" name="descGallery" placeholder="Desc">
            <input type="file" name="image">
            <button type="submit" name="submit">Upload</button>
        </form>
    </div>
@endsection
