<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'passport_issue_date',
        'date_of_birth',
        'medical_name',
        'medical_issue_date',
        'medical_status',
        'mofa_no',
        'mofa_date',
        'biomatrics_date',
        'biomatric_status',
        'police_clearance_no',
        'visa_no',
        'training_info',
        'visa_stemping_date',
        'bmet_finger',
        'manpower_date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
