@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<ul>
		@foreach($category as $categoryKey => $categoryValue)
			<li><a href="{{url('product/category/'.$categoryValue->id)}}">{{$categoryValue->name}}</a></li>
		@endforeach
			</ul>
			<table class="table">
				<tr class="text-center">
					<th colspan="1000"><h1>All Product</h1></th>
				</tr>
				<tr>
					<th>name</th>
					<th>category</th>
					<th>sub category</th>
					<th>photo</th>
					<th>Action</th>
				</tr>
				@forelse($products as $productsKey => $productsValue)
					@include('product/item', ['productsValue' => $productsValue])
					@empty
					<tr>
						<td colspan="100">none</td>
					</tr>
				@endforelse
			</table>
        </div>
		<div class="col-md-4">
            <div class="card">
                <div class="card-header">Submit Category</div>
				@if(session('alert'))
					{{session('alert')}}
				@endif
                <div class="card-body">
                    <form action="{{url('product/insert')}}" method="POST" enctype="multipart/form-data">
					  @csrf
					  <div class="form-group">
						
						<label for="exampleInputName">Name</label>
						<input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="nameHelp" placeholder="Name">
						<small id="emailHelp" class="form-text text-muted">
						@error('name')
							{{$message}}
						@enderror
						</small>
						
						<label for="exampleInputDecription">Decription</label>
						<textarea name="description" class="form-control" id="exampleInputDecription" aria-describedby="titleDecription"></textarea>
						<small id="titleDecription" class="form-text text-muted">
						@error('description')
							{{$message}}
						@enderror
						</small>
						
						<label for="exampleInputPrice">Price</label>
						<input type="number" name="price" class="form-control" id="exampleInputPrice" aria-describedby="titlePrice" placeholder="Price">
						<small id="titlePrice" class="form-text text-muted">
						@error('price')
							{{$message}}
						@enderror
						</small>
						
						<label for="exampleInputCategory">Category</label>
						<select name="category" class="form-control" id="exampleInputCategory" aria-describedby="titleHelp">
						@foreach($category as $categoryKey => $categoryValue)
							<option value="{{$categoryValue->id}}">{{$categoryValue->name}}</option>
						@endforeach
						</select>
						<small id="titleCategory" class="form-text text-muted">
						@error('category')
							{{$message}}
						@enderror
						</small>
						
						<label for="exampleInputSubCategory">Sub Category</label>
						<select name="sub_category" class="form-control" id="exampleInputSubCategory" aria-describedby="titleSubCategory">
						@foreach($subcategory as $subcategoryKey => $subcategoryValue)
							<option value="{{$subcategoryValue->id}}">{{$subcategoryValue->name}}</option>
						@endforeach
						</select>
						<small id="titleSubCategory" class="form-text text-muted">
						@error('sub_category')
							{{$message}}
						@enderror
						</small>
						
						<label for="exampleInputQuantity">Quantity</label>
						<input type="number" name="quantity" class="form-control" id="exampleInputQuantity" aria-describedby="titleQuantity" placeholder="Quantity">
						<small id="titleQuantity" class="form-text text-muted">
						@error('quantity')
							{{$message}}
						@enderror
						</small>
						
						<label for="exampleInputPhoto">Photo</label>
						<input type="file" name="photo" class="form-control" id="exampleInputPhoto" aria-describedby="titlePhoto">
						<small id="titlePhoto" class="form-text text-muted">
						@error('photo')
							{{$message}}
						@enderror
						</small>
						
						<label for="exampleInputThumbnail">Thumbnail</label>
						<input type="file" name="thumbnail[]" class="form-control" id="exampleInputThumbnail" aria-describedby="titleThumbnail" multiple>
						<small id="titleThumbnail" class="form-text text-muted">
						@error('thumbnail')
							{{$message}}
						@enderror
						</small>
						
					  </div>
					  <br />
					  <button type="submit" name="insert" class="btn btn-primary">Submit</button>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
