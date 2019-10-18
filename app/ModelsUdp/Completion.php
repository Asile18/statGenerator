<?php

namespace App\ModelsUdp;

use Illuminate\Database\Eloquent\Model;

class Completion extends Model
{
    /**
	 * All attributes are mass assignable.
	 *
	 * @var array
	 */
    protected $guarded = [];
    protected $connection = 'udp';

    public function prospects(){
        return $this->hasMany('App\ModelsUdp\Prospect', 'completion_id', 'id');
    }
}
