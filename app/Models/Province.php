<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        "island_id",
        "name",
        "alt_name",
        "latitude",
        "longitude"
    ];

    public function island()
    {
        return $this->belongsTo(Island::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
