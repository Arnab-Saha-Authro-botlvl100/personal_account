<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contracts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_no',
      
        'profit',
        'date',
        'agent',
        'agent_price',
        'supplier',
        'supplier_price',
        'user',
        'customer_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'profit' => 'decimal:2',
        'agent_price' => 'decimal:2',
        'supplier_price' => 'decimal:2',
    ];

    /**
     * Get the customer associated with the contract.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Get the user associated with the contract.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent'); // 'agent' is the foreign key in the contracts table
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier'); // 'supplier' is the foreign key in the contracts table
    }
}