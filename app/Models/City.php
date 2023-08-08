<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        "province_id",
        "name",
        "alt_name",
        "latitude",
        "longitude"
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function travels()
    {
        return $this->hasMany(Travel::class);
    }
}
