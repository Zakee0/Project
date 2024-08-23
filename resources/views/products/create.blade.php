@extends('main.app')
@section('content')


<nav class="navbar navbar-dark bg-dark">
  <div class="container">
  <a href="{{ route('products.index') }}" class="btn btn-danger mt-3 ">Home</a>

  </div>
</nav>
{{-- navbar  --}}
<div>
    <h2 class="text-center mt-3">Create a Product</h2>
</div>
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col md-5">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-3 mt-3">
                  <label for="name" class="form-label">Name:</label>
                  <input type="name" class="form-control" id="name" placeholder="Enter name" name="name" >
                  @if($errors->has('name'))
                  <div class="alert alert-danger">{{ $errors->first('name') }}</div>
              @endif
                </div>

                <div class="mb-3 mt-3">
                  <label for="description" class="form-label">Description:</label>
                  <input type="description" class="form-control" id="description" placeholder="Enter description" name="description">
                  @if($errors->has('description'))
                  <div class="alert alert-danger">{{ $errors->first('description') }}</div>
              @endif
                </div>

                <div class="mb-3 mt-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" id="image" placeholder="Upload image" name="image">
                    
                  </div>

                  {{-- <div class="mb-3 mt-3">
                    <label for="category_id" class="form-label">Category:</label>
                    <input type="name" class="form-control" id="category_id" placeholder="select category" name="category_id">
                  </div> --}}
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

              
                
               
                <button type="submit" class="btn btn-dark">Create</button>
              </form>
            
        </div>
    </div>
</div>


@endsection