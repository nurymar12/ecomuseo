<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentDonation extends Model
{
    use HasFactory;

    protected $table = 'component_donation';

    protected $fillable = [
        'donation_id',
        'components_id',
        'amount',
    ];
}
