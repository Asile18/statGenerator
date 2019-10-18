<?php

namespace App\ModelsUdp;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
	 * All attributes are mass assignable.
	 *
	 * @var array
	 */
    protected $guarded = [];
    protected $connection = 'udp';

    public function prospects(){
        return $this->hasMany('App\ModelsUdp\Prospect', 'state_id', 'id');
    }
}
