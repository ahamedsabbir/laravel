<?php
function cat_edit_function($data){
	foreach($data as $dataValue){
		$action = url('category/update/'.$dataValue->id);
?>
<div class="modal fade" id="exampleModal{{$dataValue->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<form action="{{$action}}" method="post">
			@csrf
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">name:</label>
            <input type="text" class="form-control" id="recipient-name" name="name" value="{{$dataValue->name}}">
          </div>
		  <div class="mb-3">
            <label for="recipient-title" class="col-form-label">title:</label>
            <input type="text" class="form-control" id="recipient-title" name="title" value="{{$dataValue->title}}">
          </div>
		  <button class="btn" type="submit" name="submit" value="update">update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
	}
}
?>