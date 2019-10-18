<?php

namespace App\ModelsAstuceCredit;

use Illuminate\Database\Eloquent\Model;

class Completion extends Model
{
    /**
	 * All attributes are mass assignable.
	 *
	 * @var array
	 */
    protected $guarded = [];
    protected $connection = 'astuceCredit';
    public function prospects(){
        return $this->hasMany('App\ModelsAstuceCredit\Prospect', 'completion_id', 'id');
    }
}
