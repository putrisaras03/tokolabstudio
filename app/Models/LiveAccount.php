<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveAccount extends Model
{
    protected $fillable = ['name', 'studio_id'];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'account_category');
    }
}
