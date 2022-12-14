<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'details';
    protected $fillable = ['user_id', 'country'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
