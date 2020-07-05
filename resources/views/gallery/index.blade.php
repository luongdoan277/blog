@extends('welcome')

@section('main')
    <div class="gallery-links">
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-6"><h2>Gallery</h2></div>
                <div class="col-lg-6 text-right">
                    <a href="{{ route('create')}}" class="btn btn-primary">New gallery</a>
                </div>
            </div>
            <div class="gallery-container">
                @foreach($Gallery as $gallery)
                    <a href="#">
                        <div style="background-image: url(img/gallery/{{$gallery->imgFullNameGallery}});"></div>
                        <h3>{{$gallery->titleGallery}}</h3>
                        <p>{{$gallery->descGallery}}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
