@extends('la.layouts.app')

@section('htmlheader_title')
	Match View
@endsection


@section('main-content')
<div id="page-content" class="profile2">
	<div class="bg-primary clearfix">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-1">
					<!--<img class="profile-image" src="{{ asset('la-assets/img/avatar5.png') }}" alt="">-->
					<div class="profile-icon text-primary"><i class="fa {{ $module->fa_icon }}"></i></div>
				</div>
				<div class="col-md-11">
					<h4 class="name">{{ $match->$view_col }}</h4>

				</div>
			</div>
		</div>


		<div class="col-md-1 actions">

		</div>
	</div>

	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/match') }}" data-toggle="tooltip" data-placement="right" title="Back to Match"><i class="fa fa-chevron-left"></i></a></li>
		<li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General Info</a></li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active fade in" id="tab-info">
			<div class="tab-content">
				<div class="panel infolist">
					<div class="panel-default panel-heading">
						<h4>General Info</h4>
					</div>
					<div class="panel-body">
						@la_display($module, 'game_hash')
						{!! \App\Common\FormMaker::display($module, 'player_id') !!}
						@la_display($module, 'bet')
						@la_display($module, 'stake')
						@la_display($module, 'num_mines')
						@la_display($module, 'gametype')
						@la_display($module, 'minePositions')
						@la_display($module, 'secret')
						@la_display($module, 'secret_click')
						@la_display($module, 'random_string')
					</div>
				</div>
			</div>
		</div>

	</div>
	</div>
	</div>
</div>
@endsection
