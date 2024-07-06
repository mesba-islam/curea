<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'license_number',
        'department',
        'mobile',
        'user_id'
    ];
    use HasFactory;
    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
