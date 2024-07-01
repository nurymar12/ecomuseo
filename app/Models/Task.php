<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'task_volunteer')
            ->withPivot(['volunteer_id', 'assigned_date', 'completed_date', 'status'])
            ->using(TaskVolunteer::class)->withTimestamps();
    }
}
