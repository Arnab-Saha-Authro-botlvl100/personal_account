<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousDue extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'agent_id',
        'supplier_id',
        'amount',
        'user',
        'note',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
