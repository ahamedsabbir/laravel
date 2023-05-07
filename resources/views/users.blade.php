@extends('starlight/app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<table class="table">
				<tr class="text-center">
					<th colspan="1000"><h1>Total User</h1></th>
				</tr>
				<tr>
					<th>name</th>
					<th>email</th>
					<th>role</th>
					<th>Action</th>
				</tr>
				@forelse($users as $usersKey => $usersValue){
					<tr>
						<td>{{$usersValue->name}}</td>
						<td>{{$usersValue->email}}</td>
						<td>{{$usersValue->role}}</td>
						<td>
							<a href="" >update</a> ||
							<a href="" >delete</a>
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