<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $guarded = ['id'];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function categories() {
        return $this->hasMany(Category::class);
    }
}
