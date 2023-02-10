<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['country_id', 'state'];

    public function countries()
    {
        $this->belongsTo(Country::class);
    }

    public function cities()
    {
        $this->hasMany(City::class);
    }
}
