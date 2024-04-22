<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ncdFollowup extends Model
{
    use HasFactory;
    protected $fillable= [
        'Clinic_code',
        'Pid',
        'FuchiaID',
        'Visit_date',
        'Reg_Date',
        'Agey',
        'Gender',
        'Area_Division',
        'Township',
        'NCD_Diagnosis',
        'Follow_Height',
        'Follow_Weight',
        'Follow_Bmi',
        'Type_cur_visit',
        'Late_visit',
        'Late_duration',
        'Late_duration_unit',
        'Late_follow',
        'Late_fol_duration',
        
        'Time',
        'own_clinic_Bp',
        'own_Bp_Stage',
        'FBS',
        'FBS_test_date',
        '2HPP',
        '2HPP_test_date',
        'Loaction_test',
        'Lab_res_Date',
        'Alt',
        'HBA1C',
        'Uring_AC_ratio',
        'Glucose_res',
        'Protein_res',
        'Creatinine',
        'Creat_unit',
        'CRCL',
        'Total_cholesterol',
        'Total_cho_Unit',
        'CVD_Risk',
        'HDL',
        'HDL_unit',
        'LDL',
        'LDL_unit',
        'Triglyceride',
        'Triglyceride_unit',
        'Pulse',
        'Pulse_rate',
        'Diabetic_foot',
        'Diabetic_Neuropathy',
        'Lifestyle advice',
        'Medication changed',
        'Patient_adhe medic',
        'Drug_Supply',
        'F_Amlodipine_dose',
        'F_Amlodipine_Freq',
        'F_Amlodipine_duration',
        'F_Amlodipine_durUnit',

        'F_Enalapril_dose',
        'F_Enalapril_Freq',
        'F_Enalapril_duration',
        'F_Enalapril_durUnit',
        
        'F_Atorvastain_dose',
        'F_Atorvastain_Freq',
        'F_Atorvastain_duration',
        'F_Atorvastain_durUnit',
        
        'F_Hydrochlorothiazide_dose',
        'F_Hydrochlorothiazide_Freq',
        'F_Hydrochlorothiazide_duration',
        'F_Hydrochlorothiazide_durUnit',

        'F_Aspirin_dose',
        'F_Aspirin_Freq',
        'F_Aspirin_duration',
        'F_Aspirin_durUnit',

        'F_Metformin(500)_dose',
        'F_ Metformin(500)_Freq',
        'F_Metformin(500)_duration',
        'F_Metformin(500)_durUnit',

        'F_Metformin(1000)_dose',
        'F_ Metformin(1000)_Freq',
        'F_Metformin(1000)_duration',
        'F_Metformin(1000)_durUnit',

        'F_Gliclazide(500)_dose',
        'F_Gliclazide(500)_Freq',
        'F_Gliclazide(500)_duraion',
        'F_Gliclazide(500)_durUnit',

        'F_Gliclazide(1000)_dose',
        'F_ Gliclazide(1000)_Freq',
        'F_Gliclazide(1000)_duration',
        'F_Gliclazide(1000)_durUnit',

        'Symptom hypoglycemia',
        'Foth_medi',
        'Foth_medi_spec',
        'Out_come',
        'Tout_mam_clinic',
        'death_date',
        'Tout_physician_data',
        
        'Cause_of_death',
        'Fup_doc_initial',

        'Next_Appointment',
        'visit_type',//Old data (annual,followup,...)
        'RBS result',

    ];
    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"Pid","Pid");
    }
}
