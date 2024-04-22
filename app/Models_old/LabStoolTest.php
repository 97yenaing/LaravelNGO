<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabStoolTest extends Model
{
    use HasFactory;
    protected $fillable = [
                            'CID' ,
                            'fuchiacode',
                            'agey',
                            'agem',
                            'Gender',
                            'Requested Doctor',
                            'visit_date',
                            'Patient Type',
                            'Patient Type Sub',
                            'Clinic',
                            'st_stool' ,
                            'st_colour',
                            'wbc_pus_cell',
                            'st_consistency',
                            'st_rbcs',
                            'st_other',
                            'st_comment',
                            'st_lab_tech',
                            'st_issue_date'
                          ];
}
