@extends('la.layouts.app')

@section('htmlheader_title')
	Note View
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
					<h4 class="name">{{ $note->$view_col }}</h4>

				</div>
			</div>
		</div>


		<div class="col-md-1 actions">
			@la_access("Notes", "edit")
				<a href="{{ url(config('laraadmin.adminRoute') . '/notes/'.$note->id.'/edit') }}" class="btn btn-xs btn-edit btn-default"><i class="fa fa-pencil"></i></a><br>
			@endla_access
			
			@la_access("Notes", "delete")
				{{ Form::open(['route' => [config('laraadmin.adminRoute') . '.notes.destroy', $note->id], 'method' => 'delete', 'style'=>'display:inline']) }}
					<button class="btn btn-default btn-delete btn-xs" type="submit"><i class="fa fa-times"></i></button>
				{{ Form::close() }}
			@endla_access
		</div>
	</div>

	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/notes') }}" data-toggle="tooltip" data-placement="right" title="Back to Notes"><i class="fa fa-chevron-left"></i></a></li>
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
						@la_display($module, 'lang')
						@la_display($module, 'name')
						<div class="form-group">
							<label for="url" class="col-md-2">Image :</label>
							<div class="col-md-10 fvalue">
								@if(!empty($note->image))
									<?php echo  \App\Helpers\AppHelper::thumbimg($note->image,array("html"=>true),array("link"=>array("class"=>"fancybox")))  ?>
								@endif
							</div>
						</div>
						@la_display($module, 'content')
						@la_display($module, 'status')
						@la_display($module, 'sort')
					</div>
				</div>
			</div>
		</div>

	</div>
	</div>
	</div>
</div>
@endsection
