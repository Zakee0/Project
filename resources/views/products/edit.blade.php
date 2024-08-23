@extends('main.app')
@section('content')

<div>
    <h2 class="text-center mt-3">Edit a Product</h2>
</div>
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col md-5">
            <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 mt-3">
                  <label for="name" class="form-label">Name:</label>
                  <input type="name" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ old('name' ,$product->name) }}" >
                </div>

                <div class="mb-3 mt-3">
                  <label for="description" class="form-label">Description:</label>
                  <input type="description" class="form-control" id="description" placeholder="Enter description" name="description"  value="{{ old('name' ,$product->description) }}" >
                </div>

                <div class="mb-3 mt-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" id="image" placeholder="Upload image" name="image"  value="{{ old('name' ,$product->image) }}" >
                  </div>

                  <div class="mb-5 mt-3">
                    <label for="category_id" class="form-label">Category:</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                    <div class="alert alert-danger">{{ $errors->first('category_id') }}</div>
                @endif
                </div>
               
               
                <button type="submit" class="btn btn-dark">Update</button>
              </form>
            
        </div>
    </div>
</div>


@endsection