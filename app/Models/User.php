<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    // protected $fillable = [
    //     'firstName',
    //     'middleName',
    //     'lastName',
    //     'email', 
    //     'contactNumber', 
    //     'address', 
    //     'city', 
    //     'country', 
    //     'password', 
    //     'governmentIDType',
    //     'profilePicture',
    // ];


    public function trades()
    {
        return $this->hasMany(Trade::class);
    }
}
