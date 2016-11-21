@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/points') }}">Point</a> :
@endsection
@section("contentheader_description", $point->game_type)
@section("section", "Points")
@section("section_url", url(config('laraadmin.adminRoute') . '/points'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Points Edit : ".$point->game_type)

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

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($point, ['route' => [config('laraadmin.adminRoute') . '.points.update', $point->id ], 'method'=>'PUT', 'id' => 'point-edit-form']) !!}
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
							<?php $point->point = json_decode($point->point,true);
							?>
							<?php for($i=1;$i<25;$i++){ ?>
							<li><input type="number" class="form form-control" name="point[{{ $i  }}]" value="<?php echo (!empty($point->point[$i]))?$point->point[$i]:0 ?>"></li>
							<?php } ?>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
					@la_input($module, 'game_type')
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/points') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#point-edit-form").validate({
		
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
	hidePoint({{ $point->game_type  }})
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
