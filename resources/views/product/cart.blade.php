@extends('starlight/app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<table class="table">
				<tr class="text-center">
					<th colspan="1000"><h1>Total Product {{App\Models\Cart::where('unique', Cookie::get('unique'))->count()}}</h1></th>
				</tr>
				<tr>
					<th>name</th>
					<th>amount</th>
					<th>price</th>
					<th>total</th>
					<th>Action</th>
				</tr>
				@php 
					$total_amount = 0;
					$store_out = false;
				@endphp
				@forelse($carts as $cartsKey => $cartsValue)
					<tr>
						<td>{{App\Models\Product::find($cartsValue->product_id)->name}}</td>
						<td>
						@if($cartsValue->amount > App\Models\Product::find($cartsValue->product_id)->quantity)
							<b>{{$cartsValue->amount}}</b><span>less some product</span>
							@php
								$store_out = true;
							@endphp
						@else
							<b>{{$cartsValue->amount}}</b>
						@endif	
						</td>
						<td>{{App\Models\Product::find($cartsValue->product_id)->price}}</td>
						<td>{{$total = $cartsValue->amount * App\Models\Product::find($cartsValue->product_id)->price}}</td>
						<td>
							<a href="{{url('cart/delete/'.$cartsValue->id)}}">delete</a>
						</td>
					</tr>
					@php 
						$total_amount += $total;
					@endphp
					@empty
					<tr>
						<td colspan="100">none</td>
					</tr>
				@endforelse
				<tr>
					<td><button class="btn btn-info" id="discount_button" onclick="cartlink()">enter</button></td>
					<td><input type="text" id="discount_name" /></td>
					<td>T {{$total_amount}}</td>
					<td>D {{$discount_amount = ($total_amount*$discount)/100}}</td>
					<td>D {{$total_amount - $discount_amount}}</td>
					@php
						session(['total' => $total_amount, 'discount' => $discount_amount]);
					@endphp
				</tr>
			</table>
			@if($store_out == false)
				<a class="btn" href="{{url('checkout')}}" >Buy Now</a>
			@else
				<b>Some Product running out store</b>
			@endif
        </div>
    </div>
</div>

<script type="text/javascript">
function cartlink(){
	window.location.href = "{{url('cart')}}"+'/'+$('#discount_name').val();
};
</script>
@endsection