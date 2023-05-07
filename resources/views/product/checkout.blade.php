@extends('layouts/app')
@section('content')
<meta name="csrf-token" content="{{csrf_token()}}" >
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
      <h2>Checkout form</h2>
      <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
    </div>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your cart</span>
          <span class="badge bg-primary rounded-pill">{{App\Models\Cart::where('unique', Cookie::get('unique'))->count()}}</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Total</h6>
              <small class="text-muted"></small>
            </div>
            <span class="text-muted">{{session('total')}}</span>
          </li>
		  <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Discount</h6>
              <small class="text-muted"></small>
            </div>
            <span class="text-muted">{{session('discount')}}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (USD)</span>
            <strong>{{session('total')-session('discount')}}</strong>
          </li>
        </ul>

      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Billing address</h4>
        <form class="needs-validation" novalidate action="{{url('checkout/payment/offline')}}" method="post">
		@csrf
          <div class="row g-3">
            <div class="col-sm-12">
              <label for="firstName" class="form-label">name</label>
              <input type="text" class="form-control" id="firstName" placeholder="{{Auth::user()->name}}" name="name" value="{{Auth::user()->name}}" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" placeholder="{{Auth::user()->email}}">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Country</label>
              <select class="form-select" name="country" id="country" onchange="getCityData()" required>
                <option value="">Choose...</option>
                @foreach($countries as $countriesKey => $countriesValue)
					<option value="{{$countriesValue->id}}">{{$countriesValue->name}}</option>
				@endforeach
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
              <select class="form-select" name="city" id="state" required>
                <option>select</option>
              </select>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" name="zip" class="form-control" id="zip" placeholder="" required>
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>

			<div class="col-12">
              <label for="address" class="form-label">Address</label>
              <input type="text" name="address" class="form-control" id="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

			<div class="col-12">
              <label for="address" class="form-label">Notes</label>
              <textarea name="notes" class="form-control" ></textarea>
            </div>

          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="method" value="1" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">online</label>
            </div>
            <div class="form-check">
              <input id="debit" name="method" value="2" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="debit">offline</label>
            </div>
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017–2021 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
@endsection
@section('script')
<script>
function getCityData(){
	var country_id = $('#country').val();
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type : 'POST',
		url : 'get/city/data',
		data : {country_id:country_id},
		success : function(data){
			$('#state').html(data);
		}
	});
};
</script>
@endsection
