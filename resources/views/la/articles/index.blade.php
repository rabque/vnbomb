@extends("la.layouts.app")

@section("contentheader_title", "Articles")
@section("contentheader_description", "Articles listing")
@section("section", "Articles")
@section("sub_section", "Listing")
@section("htmlheader_title", "Articles Listing")

@section("headerElems")
@la_access("Articles", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Article</button>
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
				{!! Form::input('text', "keyword", null, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">

				<label class="sr-only" for="">Parent</label>
				{!! Form::select('cate_id', $categories, null, ['class' => 'form-control']) !!}

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

@la_access("Articles", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Article</h4>
			</div>
			{!! Form::open(['action' => 'LA\ArticlesController@store', 'id' => 'article-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
					@la_input($module, 'lang')
					@la_input($module, 'status')
					@la_input($module, 'name')
					@la_input($module, 'slug')
					@la_input($module, 'module_id')
					@la_input($module, 'cate_id')
					<?php echo \App\Common\FormMaker::input($module,"image") ?>
					@la_input($module, 'description')
					@la_input($module, 'content')
					@la_input($module, 'sort')
					@la_input($module, 'metaTitle')
					@la_input($module, 'metaDes')
					@la_input($module, 'metaKey')
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
	table = $("#example1").DataTable({
		processing: true,
        serverSide: true,
		ajax: {
			url: "{{ url(config('laraadmin.adminRoute') . '/article_dt_ajax') }}",
			data: function (d) {
				d.keyword = $('input[name=keyword]').val();
				d.category = $('select[name=cate_id]').val();
				d.lang = $('select[name=lang]').val();
			}
		},
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#article-add-form").validate({
		
	});
	$('#search-form').on('submit', function(e) {
		table.draw();
		e.preventDefault();
	});
});
</script>
@endpush
