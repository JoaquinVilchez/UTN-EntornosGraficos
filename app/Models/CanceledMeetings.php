<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanceledMeetings extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

}
