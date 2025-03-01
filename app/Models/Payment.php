<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
     // Specify the table name if it's not the plural form of the model name
     protected $table = 'payments';

     // Define the fillable fields
     protected $fillable = [
         'date',
         'receive_type',
         'customer_id',
         'customer_name',
         'contract_invoice',
         'payment_amount',
         'transaction_method',
         'bank_name',
         'account_number',
         'branch_name',
         'amount',
         'user',
         'note',
     ];
 
     // Define relationships if needed
     public function customer()
     {
         return $this->belongsTo(Customer::class);
     }
}
