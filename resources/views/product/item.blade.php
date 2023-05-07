<tr>
	<td>{{$productsValue->name}}</td>
	<td>{{$productsValue->name}}</td>
	<td>{{$productsValue->name}}</td>
	<td><img src="{{asset('/upload/product/'.$productsValue->photo)}}" style="width:50px;"/></td>
	<td>
		<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
		  <div class="btn-group" role="group">
			<button id="btnGroupDrop1" type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
			  option
			</button>
			<ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
			  <li><a class="dropdown-item" href="{{url('product/open/'.$productsValue->id)}}">Open</a></li>
			  <li><a class="dropdown-item" href="{{url('product/delete/'.$productsValue->id)}}">Delete</a></li>
			  <li><a class="dropdown-item" href="{{url('product/restore/'.$productsValue->id)}}">Restore</a></li>
			  <li><a class="dropdown-item" href="{{url('product/remove/'.$productsValue->id)}}">Remove</a></li>
			</ul>
		  </div>
		</div>
	</td>
</tr>
