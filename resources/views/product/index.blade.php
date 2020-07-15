@extends('layour')

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Product</h1>
            <div>
                <a href="{{ route('product.create')}}" class="btn btn-primary">New product</a>
            </div>
            <div class="flex-center position-ref full-height">
                <div class="content">
                    <form class="typeahead" role="search">
                        <input type="search" name="q" class="form-control search-input" placeholder="Name or Id" autocomplete="off">
                    </form>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Price</td>
                </tr>
                </thead>
                <tbody>
                @foreach($Product as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td><img src="img/gallery/{{$product->imgFull}}" width="250" height="250" alt="img"></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            <a href="{{ route('product.edit', $product->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('product.destroy', $product->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
