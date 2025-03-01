<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'flight_date',
        'airline',
        'pnr_no',
        'ticket_no',
        'flight_no',
        'sector',
        'class',
        'departure_time',
        'arrival_time',
        'baggage',
        'food',
        'is_delete',
        'is_active',
        'user',
    ];

    protected $casts = [
        'baggage' => 'boolean',
        'food' => 'string',
        'is_delete' => 'integer',
        'is_active' => 'integer',
        'flight_date' => 'date',
        'departure_time' => 'datetime:H:i',
        'arrival_time' => 'datetime:H:i',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}