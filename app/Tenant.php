<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    public function resources() {
    	return $this->hasMany('App\Resource', 'tenant_id', 'tenantid');
    }

    public function subscriptions() {
    	return $this->hasMany('App\Subscription', 'tenant_id', 'tenantid');
    }
}
