<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;

    protected $table = 'user_requests'; // <--- مهم جدًا
    protected $fillable = [
        'user_id',
        'type',
        'status',
        'result_type',
        'certificate_data',
        'certificate_issued_at',
    ];
}
