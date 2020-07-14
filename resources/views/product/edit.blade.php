@extends('layour')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Update a product</h1>
            <form method="post" action="{{ route('product.update', $product->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value={{ $product->name }} />
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" value={{ $product->price }} />
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="text" class="form-control" name="image" value={{ $product->imgFull }} />
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
