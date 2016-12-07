@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/withdraws') }}">Withdraw</a> :
@endsection
@section("contentheader_description", $withdraw->$view_col)
@section("section", "Withdraws")
@section("section_url", url(config('laraadmin.adminRoute') . '/withdraws'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Withdraws Edit : ".$withdraw->$view_col)

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
				{!! Form::model($withdraw, ['route' => [config('laraadmin.adminRoute') . '.withdraws.update', $withdraw->id ], 'method'=>'PUT', 'id' => 'withdraw-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'player_id')
					@la_input($module, 'address')
					@la_input($module, 'amount')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/withdraws') }}">Cancel</a></button>
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
	$("#withdraw-edit-form").validate({
		
	});
});
</script>
@endpush
