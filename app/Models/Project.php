<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use SoftDeletes;

    protected $table="projects";

    protected $fillable=["name","description","type","amount","status","user_id"];



    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getStatus()
    {
        return $this->belongsTo(ProjectStatus::class, 'status');
    }
}