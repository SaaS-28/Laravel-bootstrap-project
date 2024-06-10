<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id'); // "belongsTo" shows that this istance (Post in this case) belongs to a model (USer in this case). So is a many-to-one situation 
    }
}
