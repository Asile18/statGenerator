<?php

namespace App\ModelsUdp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
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

    public function rates(){
        return $this->hasMany('App\ModelsUdp\Rate', 'loan_id', 'id');
    }

    public function prospects(){
        return $this->hasMany('App\ModelsUdp\Prospect', 'loan_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active', '<>', 1);
    }
}
