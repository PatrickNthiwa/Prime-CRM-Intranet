<?php

namespace App\Models;

//use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
     use HasFactory;

    // use SoftDeletes;

    public $timestamps = true;

    protected $table = "files";

    protected $fillable=["name","file","type","user_id"];



    public function getType()
    {
        return $this->belongsTo(FileType::class, 'type');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function modifiedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


