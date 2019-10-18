<?php

namespace App\ModelsUdp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
	use SoftDeletes;
    
    /**
	 * All attributes are mass assignable.
	 *
	 * @var array
	 */
    protected $guarded = [];
    protected $connection = 'udp';
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
