<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the medical_data associated with the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function medical_data(): HasOne
    {
        return $this->hasOne(MedicalData::class);
    }

    /**
     * Get all of the patient_registration for the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patient_registration(): HasMany
    {
        return $this->hasMany(PatientRegistration::class);
    }
}
