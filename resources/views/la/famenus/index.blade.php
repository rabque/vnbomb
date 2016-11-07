@extends("la.layouts.app")

<?php
use Dwij\Laraadmin\Models\Module;

$position = \Config::get("constants.POSITION_MENU");
?>

@section("contentheader_title", "Menus")
@section("contentheader_description", "Editor")
@section("section", "Menus")
@section("sub_section", "Editor")
@section("htmlheader_title", "Menu Editor")

@section("headerElems")

@endsection

@section("main-content")

	<div class="box box-success menus">
		<!--<div class="box-header"></div>-->
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-lg-4">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab-modules" data-toggle="tab">Modules</a></li>
							<li><a href="#tab-custom-link" data-toggle="tab">Custom Links</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab-modules">
								<div class="panel panel-default">
									<div class="panel-heading">
										Categories
									</div>
									<div class="panel-body">
										<ul>
											<?php echo \App\Helpers\AppHelper::print_menu_tree($categories)  ?>
										</ul>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="panel panel-default">
									<div class="panel-heading">
										Modules
									</div>
									<div class="panel-body">
										<ul>
											@foreach ($modules as $module)
												<li>{{ $module->name }} <a module_id="{{ $module->id }}" class="addModuleMenu pull-right"><i class="fa fa-plus"></i></a></li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tab-custom-link">
								{!! Form::open(['action' => '\App\Http\Controllers\LA\FAMenusController@store', 'id' => 'menu-custom-form']) !!}
								<input type="hidden" name="type" value="custom">
								<div class="form-group">
									<label for="url" style="font-weight:normal;">URL</label>
									<input class="form-control" placeholder="URL" name="url" type="text" value="http://" data-rule-minlength="1" required>
								</div>
								<div class="form-group">
									<label for="name" style="font-weight:normal;">Label</label>
									<input class="form-control" placeholder="Label" name="name" type="text" value=""  data-rule-minlength="1" required>
								</div>
								<div class="form-group">
									<label for="name" style="font-weight:normal;float: left;">Position</label>
									{{ Form::select("position",$position,null,array("class"=>"form-control","style"=>"width:70%"))  }}
								</div>


								<input type="submit" class="btn btn-primary pull-right mr10" value="Add to menu">
								{!! Form::close() !!}
							</div>
						</div><!-- /.tab-content -->
					</div><!-- nav-tabs-custom -->
				</div>
				<div class="col-md-8 col-lg-8">
					<div class="form-group">
						<label for="name" style="font-weight:normal;">Position</label>
						{{ Form::select("position",$position,$position_value,array("class"=>"form-control","id"=>"position_value"))  }}
					</div>
					<div class="dd" id="menu-nestable">
						<ol class="dd-list">
							@foreach ($menus as $menu)
								<?php echo \App\Helpers\AppHelper::print_menu_editor($menu); ?>
							@endforeach
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="EditModal" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit Menu Item</h4>
				</div>
				{!! Form::open(['action' => ['\App\Http\Controllers\LA\FAMenusController@update', 1], 'id' => 'menu-edit-form']) !!}
				<input name="_method" type="hidden" value="PUT">
				<div class="modal-body">
					<div class="box-body">
						<input type="hidden" name="type" value="custom">
						<div class="form-group">
							<label for="url" style="font-weight:normal;">URL</label>
							<input class="form-control" placeholder="URL" name="url" type="text" value="http://" data-rule-minlength="1" required>
						</div>
						<div class="form-group">
							<label for="name" style="font-weight:normal;">Label</label>
							<input class="form-control" placeholder="Label" name="name" type="text" value=""  data-rule-minlength="1" required>
						</div>
						<div class="form-group">
							<label for="name" style="font-weight:normal;">Position</label>
							{{ Form::select("position",$position,null,array("class"=>"form-control"))  }}
						</div>
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

@endsection

@push('scripts')
<script src="{{ asset('la-assets/plugins/nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('la-assets/plugins/iconpicker/fontawesome-iconpicker.js') }}"></script>
<script>
	$(function () {

		$("#position_value").on("change",function(){
			$("#position_custom").val(this.value);
			window.location.href = '<?php echo url(config('laraadmin.adminRoute') . '/famenus?position=') ?>' + this.value;

		});

		$('input[name=icon]').iconpicker();

		$('#menu-nestable').nestable({
			group: 1
		});
		$('#menu-nestable').on('change', function() {
			var jsonData = $('#menu-nestable').nestable('serialize');
			// console.log(jsonData);
			$.ajax({
				url: "{{ url(config('laraadmin.adminRoute') . '/famenus/update_hierarchy') }}",
				method: 'POST',
				data: {
					jsonData: jsonData,
					"_token": '{{ csrf_token() }}'
				},
				success: function( data ) {
					// console.log(data);
				}
			});
		});
		$("#menu-custom-form").validate({

		});

		$("#menu-nestable .editMenuBtn").on("click", function() {
			var info = JSON.parse($(this).attr("info"));
			var url = $("#menu-edit-form").attr("action");
			index = url.lastIndexOf("/");
			url2 = url.substring(0, index+1)+info.id;
			// console.log(url2);
			$("#menu-edit-form").attr("action", url2)
			$("#EditModal input[name=url]").val(info.url);
			$("#EditModal input[name=name]").val(info.name);
			$("#EditModal select[name=position]").val(info.position);
			$("#EditModal").modal("show");
		});

		$("#menu-edit-form").validate({

		});

		$("#tab-modules .addModuleMenu").on("click", function() {
			var module_id = $(this).attr("module_id");
			$.ajax({
				url: "{{ url(config('laraadmin.adminRoute') . '/famenus') }}",
				method: 'POST',
				data: {
					type: 'custom',
					table: "module",
					module_id: module_id,
					"_token": '{{ csrf_token() }}'
				},
				success: function( data ) {
					// console.log(data);
					window.location.reload();
				}
			});
		});

		$("#tab-modules .addCateMenu").on("click", function() {
			var module_id = $(this).attr("cate_id");
			$.ajax({
				url: "{{ url(config('laraadmin.adminRoute') . '/famenus') }}",
				method: 'POST',
				data: {
					type: 'custom',
					table: 'categories',
					module_id: module_id,
					"_token": '{{ csrf_token() }}'
				},
				success: function( data ) {
					// console.log(data);
					window.location.reload();
				}
			});
		});
	});
</script>
@endpush