<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedbacks'; 
    protected $fillable = ['title', 'description', 'category','feedback_user_id','product_id'];

    protected $casts = [
        'category' => 'string', 
    ];

     // Add any additional methods or relationships here

     protected static function boot()
     {
         parent::boot();
 
         static::creating(function ($feedback) {
             // Set the user_id attribute before creating the feedback
             $feedback->feedback_user_id = Auth::id();
         });
     }
    public function user()
    {
        return $this->belongsTo(User::class, 'feedback_user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
