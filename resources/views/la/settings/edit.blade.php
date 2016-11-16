@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/settings') }}">Setting</a> :
@endsection
@section("contentheader_description", $setting->$view_col)
@section("section", "Settings")
@section("section_url", url(config('laraadmin.adminRoute') . '/settings'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Settings Edit : ".$setting->$view_col)

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
				{!! Form::model($setting, ['route' => [config('laraadmin.adminRoute') . '.settings.update', $setting->id ], 'method'=>'PUT', 'id' => 'setting-edit-form']) !!}

				@la_input($module, 'name')
				@la_input($module, 'phone')
				@la_input($module, 'email')
				<?php echo \App\Common\FormMaker::input($module,"logo") ?>
				<?php echo \App\Common\FormMaker::input($module,"favicon") ?>
				@la_input($module, 'location')
				@la_input($module, 'footer')
				@la_input($module, 'google_analytics')
				@la_input($module, 'google_webmaster')
				@la_input($module, 'metaTitle')
				@la_input($module, 'metaDes')
				@la_input($module, 'metaKey')
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/settings') }}">Cancel</a></button>
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
	$("#setting-edit-form").validate({
		
	});
});
</script>
@endpush
