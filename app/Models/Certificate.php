<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_firstname',
        'owner_lastname',
        'owner_birthdate',
        'owner_birthplace',
        'result_type',
        'certificate_data',
        'status',
        'certificate_issued_at',
    ];
}
