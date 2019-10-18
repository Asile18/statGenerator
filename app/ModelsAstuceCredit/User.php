<?php

namespace App\ModelsAstuceCredit;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

/**
 * $user->assignRole('writer');
 * $user->assignRole('writer', 'admin');
 * $user->removeRole('writer');
 * $user->syncRoles(['writer', 'admin']);
 * $user->hasRole('writer');
 * $user->hasAnyRole(Role::all());
 * $user->hasAllRoles(Role::all());
 * --------------- BLADE -----------------
@role('writer')
    I am a writer!
@else
   I am not a writer...
@endrole
 * ---------------
@hasanyrole($collectionOfRoles)
    I have one or more of these roles!
@else
    I have none of these roles...
@endhasanyrole
// or
@hasanyrole('writer|admin')
    I am either a writer or an admin or both!
@else
    I have none of these roles...
@endhasanyrole
 * --------------- 
@hasallroles($collectionOfRoles)
    I have all of these roles!
@else
    I do not have all of these roles...
@endhasallroles
// or
@hasallroles('writer|admin')
    I am both a writer and an admin!
@else
    I do not have all of these roles...
@endhasallroles
 * ---------------- MIDDLEWARE ROUTE ------------------
Route::group(['middleware' => ['permission:publish articles|edit articles']], function () {
    //
});
 * ---------------- MIDDLEWARE CONTROLLER ------------------
    $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
 */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname','firstname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $connection = 'astuceCredit';
    public function authorizeRoles($roles){
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || 
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) || 
            abort(401, 'This action is unauthorized.');
    }

    public function laravauthPhone(){

        return $this->phone;
    }


    //Relations
    public function prospects(){
        return $this->hasMany('App\ModelsAstuceCredit\Prospect', 'user_id', 'id');
    }

    public function logs()
    {
        return $this->belongsToMany('App\ModelsAstuceCredit\Prospect','logs')->withTimestamps()->withPivot('type');
    }
}
