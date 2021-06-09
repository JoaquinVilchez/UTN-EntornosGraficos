<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role');
    }

    public function students(){
        $this->users()->with('type', 'student');   
    }

    public function teachers(){
        $this->users->with('type', 'teacher');
    }


}
