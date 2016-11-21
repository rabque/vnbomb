@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/notes') }}">Note</a> :
@endsection
@section("contentheader_description", $note->$view_col)
@section("section", "Notes")
@section("section_url", url(config('laraadmin.adminRoute') . '/notes'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Notes Edit : ".$note->$view_col)

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
				{!! Form::model($note, ['route' => [config('laraadmin.adminRoute') . '.notes.update', $note->id ], 'method'=>'PUT', 'id' => 'note-edit-form']) !!}
				@la_input($module, 'lang')
					@la_input($module, 'name')
				<?php echo \App\Common\FormMaker::input($module,"image") ?>
					@la_input($module, 'content')
					@la_input($module, 'status')
					@la_input($module, 'sort')
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/notes') }}">Cancel</a></button>
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
	$("#note-edit-form").validate({
		
	});
});
</script>
@endpush
