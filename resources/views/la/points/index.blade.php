@extends("la.layouts.app")

@section("contentheader_title", "Points")
@section("contentheader_description", "Points listing")
@section("section", "Points")
@section("sub_section", "Listing")
@section("htmlheader_title", "Points Listing")

@section("headerElems")
@la_access("Points", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Point</button>
@endla_access
@endsection

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Actions</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

@la_access("Points", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Point</h4>
			</div>
			{!! Form::open(['action' => 'LA\PointsController@store', 'id' => 'point-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">

					<div class="form-group">
						<label for="point">Nhập mặc đinh</label>
						<input type="number" id="point_number" style="width: 50px" value="4">
						<button type="button" class="btn btn-sm btn-danger" onclick="removePoint()">-</button>
						<button type="button" class="btn btn-sm btn-primary" onclick="addPoint()">+</button>

					</div>

					<div class="form-group">
						<label for="point">Point* : % <button type="button" class="btn btn-sm btn-primary" onclick="resetPoint()">Reset</button></label>

						<div class="point_list">
							<ul>
						<?php for($i=1;$i<25;$i++){ ?>
						<li><input type="number" class="form form-control" name="point[{{ $i  }}]" value="0"></li>
						<?php } ?>
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
					@la_input($module, 'game_type')
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
	var table = $("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/point_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#point-add-form").validate({
		
	});

	$('select').on('select2:select', function (evt) {
		// Do something
		var value = evt.target.value;
		var startHide = hidePoint(value);
		$(".point_list ul li").each(function( index ) {
			if(index > startHide){
				$(this).hide();
			}
		});

	});
	function hidePoint(value){
		var startHide = 24 - value;
		$(".point_list ul li").each(function( index ) {
			if(index > startHide){
				$(this).hide();
			}
		});

	}
});

function addPoint(){
	var current = $("#point_number").val();
	var i= 0;
	$(".point_list ul li").each(function( index ) {
		var last = $(this).find("input").val();
		index = index + 1;
		i =  parseInt(last) +  parseInt(current*index);
		$(this).find("input").val(i);
		//i = i + parseInt(current);
		//$(this).next().find("input").val(i);
	});
}
function removePoint(){
	var current = $("#point_number").val();
	var i= current;
	$(".point_list ul li").each(function( index ) {
		var last = $(this).find("input").val();
		index = index + 1;
		i = parseInt(last) -  parseInt(current*index);
		if(i < 0) i = 0;
		$(this).find("input").val(i);
	});
}
function resetPoint(){
	$(".point_list ul li").find("input").val(0);
}
</script>
@endpush
