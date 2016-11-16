@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/socials') }}">Social</a> :
@endsection
@section("contentheader_description", $social->$view_col)
@section("section", "Socials")
@section("section_url", url(config('laraadmin.adminRoute') . '/socials'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Socials Edit : ".$social->$view_col)

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
				{!! Form::model($social, ['route' => [config('laraadmin.adminRoute') . '.socials.update', $social->id ], 'method'=>'PUT', 'id' => 'social-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'name')
					@la_input($module, 'url')
					@la_input($module, 'icon')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/socials') }}">Cancel</a></button>
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
	$("#social-edit-form").validate({
		
	});
});
</script>
@endpush
