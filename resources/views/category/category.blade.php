@extends('layouts.app')
@include('models/cat_models')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<div class="card">
                <div class="card-header">all category</div>
                <div class="card-body">
					<form action="{{url('category/mark/delete/')}}" method="post">
						@csrf
						<table class="table">
						  <thead>
							<tr>
							  <th scope="col">#</th>
							  <th scope="col">name</th>
							  <th scope="col">date</th>
							  <th scope="col">User</th>
							  <th scope="col">action</th>
							</tr>
						  </thead>
						  <tbody>
							  @foreach($category as $catkey)
							  <tr>
									<th scope="row">
										<input type="checkbox" name="id[]" value="{{$catkey->id}}" />
										{{$loop->index+1}}
									</th>
									<td title="{{$catkey->title}}">{{$catkey->name}}</td>
									<td>{{$catkey->created_at}}</td>
									<td>{{APP\Models\User::find($catkey->user)->name}}</td>
									<td>
										<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
										  <div class="btn-group" role="group">
											<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
											  option
											</button>
											<ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
											  <li><a class="dropdown-item" href="{{url('category/delete/'.$catkey->id)}}">Delete</a></li>
											  <li><a class="dropdown-item" href="{{url('category/remove/'.$catkey->id)}}">remove</a></li>
											  <li><button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal{{$catkey->id}}">Edit</button></li>
											</ul>
										  </div>
										</div>
									</td>
							  </tr>
							  @endforeach
								<tr>
								  <th scope="col"><button type="submit" value="mark_delete">Mark Delete</button></th>
								  <th scope="col"><a href="{{url('category/all/delete/')}}">All Delete</a></th>
								  <th scope="col">All Remove</th>
								  <th scope="col"></th>
								  <th scope="col"></th>
								</tr>
						  </tbody>
						</table>
					<form>
                </div>
            </div>
			<div class="py-3">
			{{ $category->links() }}
			</div>
            <div class="card">
                <div class="card-header">all category</div>
                <div class="card-body">
					<table class="table">
					  <thead>
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">name</th>
						  <th scope="col">date</th>
						  <th scope="col">User</th>
						  <th scope="col">action</th>
						</tr>
					  </thead>
					  <tbody>
						  @foreach($deletedCat as $catkey)
						  <tr>
								<th scope="row">
									<input type="checkbox" name="id[]" value="{{$catkey->id}}" />
									{{$loop->index+1}}
								</th>
								<td>{{$catkey->name}}</td>
								<td>{{$catkey->created_at}}</td>
								<td>{{App\Models\User::find($catkey->user)->name}}</td>
								<td>
									<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
									  <div class="btn-group" role="group">
										<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
										  option
										</button>
										<ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
										  <li><a class="dropdown-item" href="{{url('category/restore/'.$catkey->id)}}">restore</a></li>
										  <li><a class="dropdown-item" href="{{url('category/remove/'.$catkey->id)}}">remove</a></li>
										</ul>
									  </div>
									</div>
								</td>
						  </tr>
						  @endforeach
							<tr>
							  <th scope="col">Mark Delete</th>
							  <th scope="col">All delete</th>
							  <th scope="col">All Remove</th>
							  <th scope="col"></th>
							  <th scope="col"></th>
							</tr>
					  </tbody>
					</table>
                </div>
            </div>
			<div class="py-3">
			{{ $deletedCat->links() }}
			</div>
        </div>
		<div class="col-md-4">
            <div class="card">
                <div class="card-header">Submit Category</div>
				@if(session('alert'))
					{{session('alert')}}
				@endif
                <div class="card-body">
                    <form action="{{ url('catinsert') }}" method="POST">
					  @csrf
					  <div class="form-group">
						<label for="exampleInputName">Name</label>
						<input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="nameHelp" placeholder="Name">
						<small id="emailHelp" class="form-text text-muted">
						@error('name')
							{{$message}}
						@enderror
						</small>
						<label for="exampleInputTitle">Title</label>
						<input type="text" name="title" class="form-control" id="exampleInputTitle" aria-describedby="titleHelp" placeholder="Title">
						<small id="emailHelp" class="form-text text-muted">
						@error('title')
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
{{cat_edit_function($category)}}
@endsection
