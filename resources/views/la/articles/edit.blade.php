@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/articles') }}">Article</a> :
@endsection
@section("contentheader_description", $article->$view_col)
@section("section", "Articles")
@section("section_url", url(config('laraadmin.adminRoute') . '/articles'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Articles Edit : ".$article->$view_col)

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
				{!! Form::model($article, ['route' => [config('laraadmin.adminRoute') . '.articles.update', $article->id ], 'method'=>'PUT', 'id' => 'article-edit-form']) !!}
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
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/articles') }}">Cancel</a></button>
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
	$("#article-edit-form").validate({
		
	});
});
</script>
@endpush
