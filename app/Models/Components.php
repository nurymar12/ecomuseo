<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Components extends Model
{
    use HasFactory;

    protected $fillable = [
        'titleComponente',
        'description',
        'contentComponente',
        'rutaImagenComponente',
    ];

    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }

    public function donations()
    {
        return $this->belongsToMany(Donation::class, 'component_donation')->withPivot('amount');
    }
}
