@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
		<div class="col-md-5">
			@if(session('error'))
				{{session('error')}}
			@elseif(session('success'))
				{{session('success')}}
			@endif
			
			
			<div class="card">
				<div class="card-header">Password Change</div>
				<div class="card-body">
					<form action="{{url('profile/password/edit/'.auth::id())}}" method="POST">
					  @csrf
					  <div class="form-group">
						
						<label for="exampleInputOldPasswordass">Old Password</label>
						<input type="password" name="old_password" class="form-control" id="exampleInputOldPasswordass" aria-describedby="nameOld" placeholder="Old Password">
						<small id="nameOld" class="form-text text-muted">
						@error('old_password')
							{{$message}}
						@enderror
						</small>
						
						
						<label for="exampleInputNewPassword">New Password</label>
						<input type="password" name="password" class="form-control" id="exampleInputNewPassword" aria-describedby="titleNew" placeholder="new password">
						<small id="titleNew" class="form-text text-muted">
						@error('password')
							{{$message}}
						@enderror
						</small>
						
						
						<label for="exampleInputConfirmationPassword">Confirm Password</label>
						<input type="password" name="password_confirmation" class="form-control" id="exampleInputConfirmationPassword" aria-describedby="titleConf" placeholder="confirm password">
						<small id="titleConf" class="form-text text-muted">
						@error('password_confirmation')
							{{$message}}
						@enderror
						</small>
						
					  </div>
					  <br />
					  <button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
			<br />
			<div class="card">
				<div class="card-header">Photo Change</div>
				<div class="card-body">
					<div>
						<img  style="width:100px; height:100px;" src="{{asset('upload/user/'.auth::User()->photo)}}" />
					</div>
					<form action="{{url('profile/photo/edit/'.auth::id())}}" method="POST" enctype="multipart/form-data">
					  @csrf
					  <div class="form-group">
						
						<label for="exampleInputProfilePhoto">Profile Photo</label>
						<input type="file" name="profile_photo" class="form-control" id="exampleInputProfilePhoto" aria-describedby="ProfilePhoto">
						<small id="ProfilePhoto" class="form-text text-muted">
						@error('profile_photo')
							{{$message}}
						@enderror
						</small>
						
					  </div>
					  <br />
					  <button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
			
			
		</div>
    </div>
</div>
@endsection
