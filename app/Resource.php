<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{

	protected $guarded = [];

    public function tenant(){
    	return $this->belongsTo('App\Tenant', 'tenantid', 'tenant_id');
    }
}
