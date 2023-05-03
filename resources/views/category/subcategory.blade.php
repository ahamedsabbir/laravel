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
						  <th scope="col">Category</th>
						  <th scope="col">delete</th>
						  <th scope="col">update</th>
						</tr>
					  </thead>
					  <tbody>
						  @foreach($subcategory as $subkey => $subvalue)
						  <tr>
							  <th scope="row">{{$loop->index+1}}</th>
							  <td>{{$subvalue->name}}</td>
							  <td>{{$subvalue->created_at}}</td>
							  <td>{{APP\Models\User::find($subvalue->user)->name}}</td>
							  <td>{{APP\Models\Category::find($subvalue->category)->name}}</td>
							  <td><a href="{{url('subcategory/delete/'.$subvalue->id)}}" >delete</a></td>
							  <td><a href="{{url('subcategory/update/'.$subvalue->id)}}" >update</a></td>
						  </tr>
						  @endforeach
							@if($subcategory->count() == 0)
							 <tr class="text-center"> 
								<td colspan="50">
									empty
								</td>
							 </tr> 
							@endif
					  </tbody>
					</table>
                </div>
            </div>
			<div class="py-5">
			{{$subcategory->links()}}
			</div>
        </div>
		<div class="col-md-4">
            <div class="card">
                <div class="card-header">Submit Category</div>
				@if(session('alert'))
					{{session('alert')}}
				@endif
                <div class="card-body">
                    <form action="{{url('subinsert')}}" method="POST">
					  @csrf
					  <div class="form-group">
						<label for="exampleInputEmail1">Category</label>
						<select name="category" class="form-control">
							<option value="">-select-</option>
							@foreach($category as $catkey => $catvalue)
								<option {{old('category') == $catvalue->id ? 'selected' : ''}} value="{{$catvalue->id}}">{{$catvalue->name}}</option>
							@endforeach
						</select>
						<small id="emailHelp" class="form-text text-muted">
						@error('category')
							{{$message}}
						@enderror
						</small>
					  </div>
					  <div class="form-group">
						<label for="exampleInputEmail1">Sub Category</label>
						<input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
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
