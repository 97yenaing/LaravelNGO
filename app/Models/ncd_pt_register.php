<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ncd_pt_register extends Model
{
    use HasFactory;
    protected $fillable = [
        'Clinic_code',
        'Pid',
        'FuchiaID',
        'visit_Age',
        'Current_Age',   
        'Gender',
        'Reg_Date',
        'Area_Division',
        'Township',
        'Height',
        'Weight',
        'Register_Bmi',
        '1stBP',
        '1stBP_date',
        '1stHypertension',
        '1st_DiagDate',
        '1st_RBS',
        '1st_RBS_date',
        '2ndBP',
        '2ndBP_date',
        '2nd_Hypertension',
        '2nd_DiagDate',
        '2nd_RBS',
        '2nd_RBS_date',
        '3rdBP',
        '3rdBP_date',
        'staging_Hypertension',
        'Clinical_Symptoms',
        'Clinical_Symptoms_Describe',
        'Smoking_Status',
        'Amlodipine_dose',
        'Amlodipine_Freq',
        'Amlodipine_duration',
        'Amlodipine_durUnit',
        'Enalapril_dose',
        'Enalapril_Freq',
        'Enalapril_duration',
        'Enalapril_durUnit',
        'Atorvastain_dose',
        'Atorvastain_Freq',
        'Atorvastain_duration',
        'Atorvastain_durUnit',
        'Hydrochlorothiazide_dose',
        'Hydrochlorothiazide_Freq',
        'Hydrochlorothiazide_duration',
        'Hydrochlorothiazide_durUnit',
        'Aspirin_dose',
        'Aspirin_Freq',
        'Aspirin_duration',
        'Aspirin_durUnit',
        'Metformin_dose',
        'Metformin_Freq',
        'Metformin_duration',
        'Metformin_durUnit',
        'Gliclazide_dose',
        'Gliclazide_Freq',
        'Gliclazide_duraion',
        'Gliclazide_durUnit',
        'Other_NCD_medication',
        'Oth_ncd_med_specify',
        'cur_med1',
        'cur_med1_dose',
        'cur_med1_freq',
        'cur_med1_duration',
        'cur_med1_durUnit',
        'cur_med2',
        'cur_med2_dose',
        'cur_med2_freq',
        'cur_med2_duration',
        'cur_med2_durUnit',
        'cur_med3',
        'cur_med3_dose',
        'cur_med3_freq',
        'cur_med3_duration',
        'cur_med3_durUnit',
        'cur_med4',
        'cur_med4_dose',
        'cur_med4_freq',
        'cur_med4_duration',
        'cur_med4_durUnit',
        'cur_med5',
        'cur_med5_dose',
        'cur_med5_freq',
        'cur_med5_duration',
        'cur_med5_durUnit',
        'cur_med6',
        'cur_med6_dose',
        'cur_med6_freq',
        'cur_med6_duration',
        'cur_med6_durUnit',
        'Dia_foot',
        'Hyperlipidemia',
        'Gestational_Diabetes',
        'Gestational_HT',
        'Neuropathy',
        'CKD',
        'CVD',
        'Atril_Fib',
        'Change_in_Vision',
        'Chronic_Lung_Disease',
        'Recur_infection',
        'Recur_infection_comment',
        'Family_Hyper',
        'Family_Diabetes',
    ];
    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"Pid","Pid");
    }
}