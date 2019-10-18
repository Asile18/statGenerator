<?php

namespace App\ModelsAstuceCredit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prospect extends Model
{
	use SoftDeletes;

    /**
	 * All attributes are mass assignable.
	 *
	 * @var array
	 */
    protected $guarded = [];
    protected $connection = 'astuceCredit';
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at','borrower_birthdate','borrower_identity_card_expired_date','borrower_housing_since','borrower_employment_since','coborrower_birthdate','coborrower_identity_card_expired_date','coborrower_housing_since','coborrower_employment_since','finished_at'];


    //Relations
    public function user(){
        return $this->belongsTo('App\ModelsAstuceCredit\User', 'user_id', 'id');
    }

    public function loan(){
        return $this->belongsTo('App\ModelsAstuceCredit\Loan', 'loan_id', 'id');
    }

    public function state(){
        return $this->belongsTo('App\ModelsAstuceCredit\State', 'state_id', 'id');
    }

    public function completion(){
        return $this->belongsTo('App\ModelsAstuceCredit\Completion', 'completion_id', 'id');
    }

    public function borrowerHousingCountry(){
        return $this->belongsTo('App\ModelsAstuceCredit\Country', 'borrower_housing_country', 'alpha2');
    }

    public function coborrowerHousingCountry(){
        return $this->belongsTo('App\ModelsAstuceCredit\Country', 'coborrower_housing_country', 'alpha2');
    }

    public function borrowerEmployerCountry(){
        return $this->belongsTo('App\ModelsAstuceCredit\Country', 'borrower_employer_country', 'alpha2');
    }

    public function coborrowerEmployerCountry(){
        return $this->belongsTo('App\ModelsAstuceCredit\Country', 'coborrower_employer_country', 'alpha2');
    }

    public function borrowerNationality(){
        return $this->belongsTo('App\ModelsAstuceCredit\Country', 'borrower_nationality', 'alpha2');
    }

    public function coborrowerNationality(){
        return $this->belongsTo('App\ModelsAstuceCredit\Country', 'coborrower_nationality', 'alpha2');
    }

    public function currentLoans(){
        return $this->hasMany('App\ModelsAstuceCredit\CurrentLoan', 'prospect_id', 'id');
    }

    public function logs()
    {
        return $this->belongsToMany('App\ModelsAstuceCredit\User','logs')->withTimestamps()->withPivot('type');
    }


    //Scope
    public function scopeAnonym($query)
    {
        return $query->where('anonym', 1);
    }

    public function scopeNotAnonym($query)
    {
        return $query->where('anonym','<>', 1)->orWhereNull('anonym');
    }
}
