<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'user_id', 'content'];

    
    protected $with = ['user'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if comment belongs to specific user (optional - not used for restrictions anymore)
    public function belongsToUser(int $userId)
    {
        return $this->user_id === $userId;
    }

}
