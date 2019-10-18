<?php

namespace App\ModelsAstuceCredit;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    protected $connection = 'astuceCredit';
    /**
	 * All attributes are mass assignable.
	 *
	 * @var array
	 */
    protected $guarded = [];
}
