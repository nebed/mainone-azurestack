<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = [];

    public function tenant(){
    	return $this->belongsTo('App\Tenant', 'tenantid', 'tenantid');
    }

    public function computequotas() {
    	return $this->hasMany('App\Computequota', 'subscriptionid', 'subscriptionid');
    }

    public function networkquotas() {
    	return $this->hasMany('App\Networkquota', 'subscriptionid', 'subscriptionid');
    }
    
    public function storagequotas() {
    	return $this->hasMany('App\Storagequota', 'subscriptionid', 'subscriptionid');
    }

    public function usage() {
    	return $this->hasMany('App\Usage', 'subscriptionid', 'subscriptionid');
    }
}
