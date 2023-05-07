@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
					<tr>
						<td>{{$productsValue->name}}</td>
						<td>{{$productsValue->name}}</td>
						<td>{{$productsValue->name}}</td>
						<td><img src="{{asset('/upload/product/'.$productsValue->photo)}}" style="width:50px;"/></td>
						<td>
							<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
							  <div class="btn-group" role="group">
								<button id="btnGroupDrop1" type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
								  option
								</button>
								<ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								  <li><a class="dropdown-item" href="{{url('product/open/'.$productsValue->id)}}">Open</a></li>
								  <li><a class="dropdown-item" href="{{url('category/restore/'.$productsValue->id)}}">Delete</a></li>
								  <li><a class="dropdown-item" href="{{url('category/restore/'.$productsValue->id)}}">Restore</a></li>
								  <li><a class="dropdown-item" href="{{url('category/remove/'.$productsValue->id)}}">Remove</a></li>
								</ul>
							  </div>
							</div>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="100">none</td>
					</tr>
				@endforelse
			</table>
        </div>
    </div>
</div>
@endsection
