<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    public function sub()
    {
        return $this->hasMany(Navigation::class, 'parent_id', 'id')->orderBy('sort','asc');
    }
}
