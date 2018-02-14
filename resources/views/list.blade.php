<!DOCTYPE html>
<html>
<head>
	<title>Ajax ToDo List Project</title>
	
	{{-- <meta name="csrf-token" content="{{ csrf_token() }}"/> --}}

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body> 
<br>
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-3 col-lg-6">
				<div class="panel panel-default">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Ajax ToDo List <a href="#" id="addNew" class="pull-right"  data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a></h3>
				  	</div>
				  	<div class="panel-body" id="items">
				    	<ul class="list-group">
				    	@foreach($items as $item)
				    	  	<li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal"">{{ $item->item}}
				    	  	<input type="hidden" id="itemId" value="{{$item->id}}">
				    	  	</li>
				    	@endforeach
				    	</ul>
				  	</div>
				</div>
			</div>

			<div class="col-lg-offset-3 col-lg-6">
				<div class="panel panel-default">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Ajax List 2<a href="#" id="addNew2" class="pull-right"  data-toggle="modal" data-target="#myModal2"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-plus glyphicon-lg"> Add</i></button></a></h3>
				  	</div>
				  	<div class="panel-body" id="items2">
				    	<ul class="list-group">
				    	@foreach($items2 as $item)
				    	  	<li class="list-group-item ourItem2">{{$item->item}}<a href="#" class="pull-right editNew2" data-toggle="modal" data-target="#myModal2"><input type="hidden" id="itemId2" value="{{$item->id}}"><i class="glyphicon glyphicon-edit fa-lg"></i></a>
				    	  	</li>
				    	@endforeach
				    	</ul>
				  	</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="title">Add New Item</h4>
			      </div>
			      <div class="modal-body">
			      	<input type="hidden" id="id">
			        <p><input type="text" placeholder="Write Item Here" id="addItem" class="form-control"></p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-warning" id="delete" data-dismiss="modal" style="display: none">Delete</button>
			        <button type="button" class="btn btn-primary" id="saveChanges" data-dismiss="modal"style="display: none">Save changes</button>
			        <button type="button" class="btn btn-primary" id="addButton" data-dismiss="modal">Add Item</button>
			      </div>
			    </div>
			  </div>
			</div>


			<!-- Modal2 -->
			<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="title2">Add New Item 2</h4>
			      </div>
			      <div class="modal-body">
			      	<input type="hidden" id="id2">
			        <p><input type="text" placeholder="Write Item Here 2" id="addItem2" class="form-control"></p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-warning" id="delete2" data-dismiss="modal" style="display: none">Delete</button>
			        <button type="button" class="btn btn-primary" id="saveChanges2" data-dismiss="modal"style="display: none">Save changes</button>
			        <button type="button" class="btn btn-primary" id="addButton2" data-dismiss="modal">Add Item</button>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>				
{{ csrf_field() }}

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script>
		$.ajaxSetup({
		    headers: {
		    	'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')
		        //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		$(document).ready(function() {
			$(document).on('click', '.ourItem', function(event) {
				var text = $(this).text();
				var id = $(this).find('#itemId').val();
				$('#title').text('Edit Item');
				var text = $.trim(text);
				$('#addItem').val(text);
				$('#delete').show('400');
				$('#saveChanges').show('400');
				$('#addButton').hide('400');
				$('#id').val(id);
				console.log(text);
			});

			$(document).on('click', '#addNew', function(event) {
				$('#title').text('Add New Item');
				$('#addItem').val("");
				$('#delete').hide('400');
				$('#saveChanges').hide('400');
				$('#addButton').show('400');
			});

			$('#addButton').click(function(event) {
				var text = $('#addItem').val();
				if (text =="") {
					alert('Please type anything for item');
				}else{
					$.post("list", {'text': text, '_token': $('input[name="_token"]').val()}, function(data) { // data - we are getting from the Controller
						console.log(data);
						$('#items').load(location.href + ' #items');  //refresh the page
					});
				}
			});

			$('#delete').click(function(event) {
				var id = $("#id").val();
				$.post('delete', {'id': id, '_token': $('input[name="_token"]').val()}, function(data){
				$('#items').load(location.href + ' #items');  //refresh the page
				//console.log(id);
				console.log(data);
				});
			});

			$('#saveChanges').click(function(event) {
				var id = $("#id").val();
				var value = $("#addItem").val();
				if (value =="") {
					alert('Please type anything for item');
				}else{
					$.post('update', {'id': id,'value': value, '_token': $('input[name="_token"]').val()}, function(data){
					$('#items').load(location.href + ' #items');  //refresh the page
					//console.log(id);
					console.log(data);
					});
				}
			});
		});

		$(document).ready(function() {
			$(document).on('click', '.ourItem2', function(event) {
				var text2 = $(this).text();
				var id2 = $(this).find('#itemId2').val();
				$('#title2').text('Edit Item 2');
				var text2 = $.trim(text2);
				$('#addItem2').val(text2);
				$('#delete2').show('400');
				$('#saveChanges2').show('400');
				$('#addButton2').hide('400');
				$('#id2').val(id2);
				console.log(text2);
			});

			$(document).on('click', '#addNew2', function(event) {
				$('#title2').text('Add New Item 2');
				$('#addItem2').val("");
				$('#delete2').hide('400');
				$('#saveChanges2').hide('400');
				$('#addButton2').show('400');
			});

			$('#addButton2').click(function(event) {
				var text2 = $('#addItem2').val();
				if (text2 =="") {
					alert('Please type anything for item');
				}else{
					$.post("list2", {'text2': text2, '_token': $('input[name="_token"]').val()}, function(data2) { // data - we are getting from the Controller
						console.log(data2);
						$('#items2').load(location.href + ' #items2');  //refresh the page
					});
				}
			});

			$('#delete2').click(function(event) {
				var id2 = $("#id2").val();
				$.post('delete2', {'id': id2, '_token': $('input[name="_token"]').val()}, function(data){
				$('#items2').load(location.href + ' #items2');  //refresh the page
				//console.log(id);
				console.log(data);
				});
			});

			$('#saveChanges2').click(function(event) {
				var id2 = $("#id2").val();
				var value2 = $("#addItem2").val();
				if (value2 =="") {
					alert('Please type anything for item');
				}else{
					$.post('update2', {'id': id2,'value2': value2, '_token': $('input[name="_token"]').val()}, function(data){
					$('#items2').load(location.href + ' #items2');  //refresh the page
					//console.log(id);
					console.log(data);
					});
				}
			});
		});

	</script>
</body>
</html>