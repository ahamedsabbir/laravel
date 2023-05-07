@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<table class="table">
				<tr class="text-center">
					<th colspan="100"><h1>All Cupon</h1></th>
				</tr>
				<tr>
					<th>name</th>
					<th>Percent</th>
					<th>Validity</th>
					<th>Action</th>
				</tr>
				@forelse($cupons as $cuponsKey => $cuponsValue)
					<tr>
						<td>{{$cuponsValue->name}}</td>
						<td>{{$cuponsValue->percent}}</td>
						<td>{{Carbon\Carbon::parse($cuponsValue->validity)->diffForHumans()}}</td>
						<td>delete</td>
					</tr>
				@empty
					<tr>
						<th colspan="100">delete</th>
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
                    <form action="{{Route('cuponinsert')}}" method="POST" enctype="multipart/form-data">
					  @csrf
					  <div class="form-group">
						
						<label for="exampleInputName">Name</label>
						<input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="nameHelp" placeholder="Name">
						<small id="emailHelp" class="form-text text-muted">
						@error('name')
							{{$message}}
						@enderror
						</small>
						
						<label for="exampleInputDecription">Percent</label>
						<input type="number" name="percent" class="form-control" id="exampleInputName" aria-describedby="nameHelp" placeholder="Name">
						<small id="titleDecription" class="form-text text-muted">
						@error('percent')
							{{$message}}
						@enderror
						</small>
						
						<label for="exampleInputQuantity">Validity</label>
						<input type="date" name="validity" class="form-control" id="exampleInputQuantity" aria-describedby="titleQuantity" placeholder="Quantity">
						<small id="titleQuantity" class="form-text text-muted">
						@error('validity')
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
