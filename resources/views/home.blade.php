@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
		<div class="row">
        <div class="row">
			<div class="col-xl-12">
				<form id="frm_details" method="post" name="frm_details">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-2">
							<div class="form-group" id="ec_idparrent">
								<input type="text" class="task_name" id="task_name" name="task_name" value="">     
							</div>
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-primary" style="background-color: black;color: white;">Add Task</button>
						</div>
					</div>
				</form>
		     </div>
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body table-border-style">
						<div class="table-responsive">
							<table class="table" id="Jq_datatablelist">
								<thead>
									<tr>
										<th>{{__('No.')}}</th>
										<th>{{__('Name')}}</th>
										<th>{{__('Status')}}</th>
										<th>{{__('Action')}}</th>
									</tr>
								</thead>
								<tbody class="">
								
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<script>
loadtasklist();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function loadtasklist(){
	var id ="";
	$.ajax({
		type: "post",
		url: "/get-list-task",
		data: {
        "_token": "{{ csrf_token() }}",
        "id": id
        },
        dataType: 'json',
		success: function (data) {
			$(".removefistserach").remove();
			$(".removetext").html('');
			var i = 1; 
			$.each(data, function (index, value){  
			   if(value.task_name == null){
				   alert('I am not available');
			   }else{
				   $('#Jq_datatablelist').append($('<tr class="removetext">')
					  .append($('<td>').append(i))
					  .append($('<td>').append(value.task_name))
					  .append($('<td>').append((value.status =='1')?'done':''))
					  .append($('<td>').append('<button style="border-radius:5px;background:green;padding:1px;" type="button" data-id="'+ value.id +'" class="edit"><i class="fa fa-check icon" style="font-size:20px;color:white"></i></button>  <button style="border-radius: 5px;background: red;padding: 1px;" type="button" data-id="'+ value.id +'" class="delete"><i class="fa fa-close icon" style="font-size:20px;color:white"></i></button>'))
					  
					)

			   }
			 i++;
			}); 
			 $('.edit').click(function () {

				 var id = $(this).attr("data-id");
				  $.ajax({
					type:'POST',
					url: "/status",
					data:'id='+id,
					success:function(data){
					   loadtasklist();
					}
				});
			});
			$('.delete').click(function () {
				var checkstr =  confirm('Are u sure to delete this task ?');
				if(checkstr == true){
					var id = $(this).attr("data-id");
					$.ajax({
					type:'POST',
					url: "/task-delete",
					data:'id='+id,
					success:function(data){
						alert (data);
					loadtasklist();
					}
				});
				}else{
				return false;
				}
			});
			
		},
		error: function (e) {
		   alert('Some things Wrong');
		}
	});
	
}

$("#frm_details").on("submit", function(event){
	event.preventDefault();
	var formData = {
		'task_name': $('input[name=task_name]').val(),
	};
	$.ajax({
		url: "/add-task",
		type: "post",
		data: formData,
		success: function(d) {
			
		loadtasklist();
		},
		error: function (e) {
		   alert('Task allready taken');
		}
	});
});
 $('.edit').click(function () {

	 var id = $(this).attr("data-id");
	  $.ajax({
		type:'POST',
		url: "/status",
		data:'id='+id,
		success:function(data){
		   loadtasklist();
		}
	});
});
$('.delete').click(function () {
	var checkstr =  confirm('Are u sure to delete this task ?');
	if(checkstr == true){
		var id = $(this).attr("data-id");
		$.ajax({
		type:'POST',
		url: "/task-delete",
		data:'id='+id,
		success:function(data){
			alert (data);
		loadtasklist();
		}
	});
	}else{
	return false;
	}
});
</script>
@endsection



