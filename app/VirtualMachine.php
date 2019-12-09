<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualMachine extends Model
{
	protected $guarded = [];
    
    public function virtualmachinedetails(){
    	return $this->belongsTo('App\AvailableVirtualMachine','vmsize', 'vmsize');
    }
    
}
