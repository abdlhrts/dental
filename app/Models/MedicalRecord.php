<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the patient_registration that owns the MedicalRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient_registration(): BelongsTo
    {
        return $this->belongsTo(PatientRegistration::class);
    }
}
