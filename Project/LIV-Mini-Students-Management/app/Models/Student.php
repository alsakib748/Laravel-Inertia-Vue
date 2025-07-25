<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    // todo: For eager loaded
    protected $with = ['class', 'section'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

}