@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
								<td>{{APP\Models\User::find($catkey->user)->name}}</td>
								<td>
									<a href="{{url('category/delete/'.$catkey->id)}}" >delete</a>
									<a href="{{url('category/delete/'.$catkey->id)}}" >remove</a>
									<a href="{{url('category/update/'.$catkey->id)}}" >update</a>
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
				{{session('alert')}}
                <div class="card-body">
                    <form action="{{ url('catinsert') }}" method="POST">
					  @csrf
					  <div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
						<small id="emailHelp" class="form-text text-muted">
						@error('name')
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
