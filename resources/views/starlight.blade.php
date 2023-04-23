@extends('starlight.app')
@include('starlight.nav')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
	<a class="breadcrumb-item" href="{{url('home')}}">Starlight</a>
	<a class="breadcrumb-item" href="index.html">Pages</a>
	<span class="breadcrumb-item active">Blank Page</span>
  </nav>
  <div class="sl-pagebody">
	<div class="sl-page-title">
	  <h5>Blank Page</h5>
	  <p>This is a starter page</p>
	</div><!-- sl-page-title -->
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">{{ __('Dashboard') }}</div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						{{ __('You are logged in!') }}
						
						@foreach($users as $users_key)
						{{$users_key->name}}
						{{$users_key->update_at}}
						@endforeach
					</div>
				</div>
			</div>
		</div>
  </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->
@endsection
