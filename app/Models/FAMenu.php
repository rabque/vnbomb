<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FAMenu extends AppModel
{
  //  use SoftDeletes;
	
	protected $table = 'famenus';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

//	protected $dates = ['deleted_at'];
}
