<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','petname','phone','address', 'category','breed','age', 'gender','breed','story','is_adopted','image','create_at','update_at'];

    protected $table = 'pets';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
