<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = ['name', 'studio_id'];

    public function liveAccounts()
    {
        return $this->hasMany(LiveAccount::class);
    }
}
