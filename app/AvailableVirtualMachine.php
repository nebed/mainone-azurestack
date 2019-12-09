<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailableVirtualMachine extends Model
{
    public function virtualmachines(){
    	return $this->hasMany('App\VirtualMachines', 'vmsize', 'vmsize');
    }
}
