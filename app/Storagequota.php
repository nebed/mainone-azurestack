<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storagequota extends Model
{
    protected $guarded = [];

    public function subscription(){
    	return $this->belongsTo('App\Subscription', 'subscriptionid', 'subscriptionid');
    }
}
