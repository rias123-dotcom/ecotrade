<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Testing\Fluent\Concerns\Has;
class Traders extends Authenticatable
{
    Use HasFactory, Notifiable; 

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $table = 'traders';
    protected $primaryKey = 'traderID';
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'address',
        'city',
        'province',
        'country',
        'email',
        'contactNumber',
        'password',
        'zipCode',
        'docType',
        'identityDoc',
        'faceVerified',
        'role',
        'accountStatus',
    ];
}
