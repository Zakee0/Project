@extends('main.app')
@section('content')

@if(Session::has('success'))
<p class="alert alert-info"><b>{{ Session::get('success') }}</b></p>
@endif

{{-- @if($errors->has())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif --}}
    

<div class="container">
<h1 class="float-start mt-5">Product data</h1>

<a class="btn btn-dark float-end mt-5" href="{{ route('products.create') }}">Create</a>
</div>

<div class="container">
<table class="table table-dark">
    <thead>
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Action</th>
      </tr>
    </thead>

@foreach ($products as $product)
    
    <tbody>
      <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td> <img src="{{ asset('images/products/' . $product->image) }}" style="width:50px; height:50px;" class="img-circle" alt="could not get image"> </td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->description }}</td>
        {{-- <td>{{ $product->category_id }}</td> --}}
        <td>{{  $product->category->name   }}</td>
        
        
        <td>
            <a class="btn btn-success" href="{{ route('products.edit', $product->id) }}">Edit</a>

            <form class="d-inline" action="{{ route('products.destroy',$product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger" type="submit" value="Delete" >
            </form>
        </td>
        
       
      
    </tbody>
@endforeach

  </table>
</div>


@endsection