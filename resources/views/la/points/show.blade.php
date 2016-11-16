@extends('la.layouts.app')

@section('htmlheader_title')
	Point View
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
					<h4 class="name">{{ $point->game_type }}</h4>

				</div>
			</div>
		</div>


		<div class="col-md-1 actions">
			@la_access("Points", "edit")
				<a href="{{ url(config('laraadmin.adminRoute') . '/points/'.$point->id.'/edit') }}" class="btn btn-xs btn-edit btn-default"><i class="fa fa-pencil"></i></a><br>
			@endla_access
			
			@la_access("Points", "delete")
				{{ Form::open(['route' => [config('laraadmin.adminRoute') . '.points.destroy', $point->id], 'method' => 'delete', 'style'=>'display:inline']) }}
					<button class="btn btn-default btn-delete btn-xs" type="submit"><i class="fa fa-times"></i></button>
				{{ Form::close() }}
			@endla_access
		</div>
	</div>

	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/points') }}" data-toggle="tooltip" data-placement="right" title="Back to Points"><i class="fa fa-chevron-left"></i></a></li>
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
						<div class="form-group">
							<label for="point">Point* : %</label>
							<div class="point_list">
								<ul>
									<?php $point->point = json_decode($point->point,true);
									?>
									<?php for($i=1;$i<25;$i++){ ?>
									<li><?php echo (!empty($point->point[$i]))?$point->point[$i]:0 ?></li>
									<?php } ?>
								</ul>
								<div class="clearfix"></div>
							</div>
						</div>
						@la_display($module, 'game_type')
					</div>
				</div>
			</div>
		</div>

	</div>
	</div>
	</div>
</div>
@endsection
