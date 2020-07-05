@extends('welcome')

@section('main')
    <div class="gallery-upload">
        <h2>Upload</h2>
        <form action="{{route('store')}}" method="post">
            @csrf
            <input type="text" name="titleGallery" placeholder="Title">
            <input type="text" name="discGallery" placeholder="Disc">
            <input type="text" name="imgFullNameGallery" placeholder="imgFullNameGallery">
            <input type="text" name="orderGallery" placeholder="orderGallery">
            <button type="submit" name="submit">Upload</button>
        </form>
    </div>
@endsection
