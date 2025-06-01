<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['project_name', 'description', 'employee_id', 'task'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
