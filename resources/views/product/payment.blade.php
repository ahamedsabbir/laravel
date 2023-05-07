@extends('starlight/app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<table class="table">
				<tr class="text-center">
					<th colspan="1000"><h1>Total Product</h1></th>
				</tr>
				<tr>
					<th>name</th>
					<th>address</th>
					<th>total</th>
					<th>discount</th>
					<th>subtotal</th>
					<th>method</th>
					<th>payment</th>
				</tr>
				@forelse($unpaidPayment as $unpaidPaymentKey => $unpaidPaymentValue)
					<tr>
						<td>{{App\Models\User::find($unpaidPaymentValue->user_id)->name}}</td>
						<td>{{$unpaidPaymentValue->address}}</td>
						<td>{{$unpaidPaymentValue->total}}</td>
						<td>{{$unpaidPaymentValue->discount}}</td>
						<td>{{$unpaidPaymentValue->subtotal}}</td>
						<td>{{$unpaidPaymentValue->method==2?'offline':'online'}}</td>
						<td>{{$unpaidPaymentValue->payment==0?'unpaid':'paid'}}</td>
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