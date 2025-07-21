<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{

    protected $table = "classes";

    protected $guarded = [];

    public function sections()
    {
        return $this->hasMany(Section::class, 'class_id');
    }

}
