<?php

namespace App\ModelsAstuceCredit;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
	 * All attributes are mass assignable.
	 *
	 * @var array
	 */
    protected $guarded = [];
    protected $connection = 'astuceCredit';
    public function prospects(){
        return $this->hasMany('App\ModelsAstuceCredit\Prospect', 'state_id', 'id');
    }
}
