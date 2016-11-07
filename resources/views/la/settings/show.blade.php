@extends('la.layouts.app')

@section('htmlheader_title')
	Setting View
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
					<h4 class="name">{{ $setting->$view_col }}</h4>

				</div>
			</div>
		</div>


		<div class="col-md-1 actions">
			@la_access("Settings", "edit")
				<a href="{{ url(config('laraadmin.adminRoute') . '/settings/'.$setting->id.'/edit') }}" class="btn btn-xs btn-edit btn-default"><i class="fa fa-pencil"></i></a><br>
			@endla_access
			
			@la_access("Settings", "delete")
				{{ Form::open(['route' => [config('laraadmin.adminRoute') . '.settings.destroy', $setting->id], 'method' => 'delete', 'style'=>'display:inline']) }}
					<button class="btn btn-default btn-delete btn-xs" type="submit"><i class="fa fa-times"></i></button>
				{{ Form::close() }}
			@endla_access
		</div>
	</div>

	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/settings') }}" data-toggle="tooltip" data-placement="right" title="Back to Settings"><i class="fa fa-chevron-left"></i></a></li>
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
						@la_display($module, 'name')
						@la_display($module, 'phone')
						@la_display($module, 'email')
						<div class="form-group">
							<label for="url" class="col-md-2">Logo :</label>
							<div class="col-md-10 fvalue">
								@if(!empty($slider->image))
									<?php echo  \App\Helpers\AppHelper::thumbimg($setting->logo,array("html"=>true),array("link"=>array("class"=>"fancybox")))  ?>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label for="url" class="col-md-2">Favicon :</label>
							<div class="col-md-10 fvalue">
								@if(!empty($slider->image))
									<?php echo  \App\Helpers\AppHelper::thumbimg($setting->favicon,array("html"=>true),array("link"=>array("class"=>"fancybox")))  ?>
								@endif
							</div>
						</div>
						@la_display($module, 'location')
						@la_display($module, 'footer')
						@la_display($module, 'google_analytics')
						@la_display($module, 'google_webmaster')
						@la_display($module, 'metaTitle')
						@la_display($module, 'metaDes')
						@la_display($module, 'metaKey')
					</div>
				</div>
			</div>
		</div>

	</div>
	</div>
	</div>
</div>
@endsection
