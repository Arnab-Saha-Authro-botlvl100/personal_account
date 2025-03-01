<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers'; // Define table name if it's not the default

    protected $fillable = [
        'name',
        'customer_id',
        'phone_number',
        'gender',
        'agent_contract',
        'supplier_contract',
        'passport_file',
        'nid_file',
        'note',
        'passport_number',
        'agent',
        'supplier',
        'service',
        
        'country_of_residence',
        'address_line_1',
        'country',
        'user', // Added user field
        'is_delete',
        'is_active',
    ];

    protected $casts = [
        'is_delete' => 'boolean',
        'is_active' => 'boolean',
        'passport_expiry_date' => 'date',
    ];

    // Relationships
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function customerDetails()
    {
        return $this->hasOne(CustomerDetails::class);
    }

}
