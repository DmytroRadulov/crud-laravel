<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
