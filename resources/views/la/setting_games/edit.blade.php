@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/setting_games') }}">Setting Game</a> :
@endsection
@section("contentheader_description", $setting_game->$view_col)
@section("section", "Setting Games")
@section("section_url", url(config('laraadmin.adminRoute') . '/setting_games'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Setting Games Edit : ".$setting_game->$view_col)

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
				{!! Form::model($setting_game, ['route' => [config('laraadmin.adminRoute') . '.setting_games.update', $setting_game->id ], 'method'=>'PUT', 'id' => 'setting_game-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'affiliate')
					@la_input($module, 'withdraw')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/setting_games') }}">Cancel</a></button>
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
	$("#setting_game-edit-form").validate({
		
	});
});
</script>
@endpush
