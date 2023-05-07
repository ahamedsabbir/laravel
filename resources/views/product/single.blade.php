@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
<style>
ul {
  list-style-image: url('{{asset('upload/product/'.$products->photo)}}');
}
</style>
			<ul>
				<li>ID: {{$products->id}}</li>
				<li>name: {{$products->name}}</li>
				<li>price: {{$products->price}}</li>
				<li>quantity: {{$products->quantity}}
					@if($products->quantity != 0)
						<form action="{{url('cart/add/'.$products->id)}}" method="post">
							@csrf
							<input type="number" name="amount"/>
							<button type="submit" name="insert">submit</button>
						<form>
					@else
						<b>not avalable</b>
					@endif
				</li>
				<li>description: {{$products->description}}</li>
				<li>category: {{APP\Models\Category::find($products->category)->name}}</li>
				<li>sub category: {{APP\Models\Subcategory::find($products->sub_category)->name}}</li>
				<li>created: {{$products->created_at}}</li>
				<li class="d-none"><img src="{{asset('upload/product/'.$products->photo)}}" style="width:150px;"/></li>
				<li> 
					@foreach(App\Models\Thumbnail::where('product_id', $products->id)->get() as $thumbnail)
						<img src="{{asset('upload/thumbnail/'.$thumbnail->name)}}" style="width:150px;"/>
					@endforeach
				</li>
			</ul>
        </div>
    </div>
</div>@php  @endphp
@endsection