@extends("la.layouts.app")

@section("contentheader_title", "Categories")
@section("contentheader_description", "Categories listing")
@section("section", "Categories")
@section("sub_section", "Listing")
@section("htmlheader_title", "Categories Listing")

@section("headerElems")
@la_access("Categories", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Category</button>
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
		<form id="search-form" action="" method="post" class="form-inline" role="form">

			<div class="form-group">
				<label class="sr-only" for="">Keyword</label>
				<input type="text" name="keyword" class="form-control" id="keyword" placeholder="Keyword">
			</div>

			<div class="form-group">

				<label class="sr-only" for="">Parent</label>
				{!! Form::select('parent_id', $categories, null, ['class' => 'form-control']) !!}

			</div>

			<div class="form-group">
				<label class="sr-only" for="">Language</label>
				{!! Form::select('lang', $languages, null, ['class' => 'form-control']) !!}

			</div>

			<button type="submit" class="btn btn-primary">Search</button>
		</form>
	</div>
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

@la_access("Categories", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Category</h4>
			</div>
			{!! Form::open(['action' => 'LA\CategoriesController@store', 'id' => 'category-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
					
					{{--
					@la_input($module, 'status')
					@la_input($module, 'name')
					@la_input($module, 'slug')
					@la_input($module, 'parent_id')
					@la_input($module, 'module_id')
					@la_input($module, 'sort')
					@la_input($module, 'metaTitle')
					@la_input($module, 'metaDes')
					@la_input($module, 'metaKey')
					--}}
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
		ajax: {
			url: "{{ url(config('laraadmin.adminRoute') . '/category_dt_ajax') }}",
			data: function (d) {
				d.keyword = $('input[name=keyword]').val();
				d.parent = $('select[name=parent_id]').val();
				d.lang = $('select[name=lang]').val();
			}
		},
		language: {
			lengthMenu: "_MENU_",
			//search: "_INPUT_",
			//searchPlaceholder: "Search"
		},
		"drawCallback": function ( settings ) {
			var api = this.api();
			var rows = api.rows({page: 'current'}).nodes();
			var last = null;

			api.column(3, {page: 'current'}).data().each(function (group, i) {
				if (last !== group) {
					$(rows).eq(i).before(
							'<tr class="group"><td colspan="9">' + group + '</td></tr>'
					);

					last = group;
				}
			});
		},

			@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#category-add-form").validate({
		
	});
	$('#search-form').on('submit', function(e) {
		table.draw();
		e.preventDefault();
	});
});
</script>
@endpush
