<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NegativeCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_lastname',
        'owner_firstname',
        'owner_father',
        'owner_birthdate',
        'owner_birthplace',

        'applicant_lastname',
        'applicant_firstname',
        'applicant_father',

        'email',
        'phone',
        'type',
        'status',
    ];
}
