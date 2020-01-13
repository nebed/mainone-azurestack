<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Networkquota extends Model
{
    protected $guarded = [];

    public function subscription(){
    	return $this->belongsTo('App\Subscription', 'subscriptionid', 'subscriptionid');
    }
}
