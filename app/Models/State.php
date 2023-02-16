<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['country_id', 'state'];

    public function country()
    {
        $this->belongsTo(Country::class, 'country_id');
    }

    public function cities()
    {
        $this->hasMany(City::class);
    }
}
