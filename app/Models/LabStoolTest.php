<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabStoolTest extends Model
{
    use HasFactory;
    protected $fillable = [
                            'id',
                            'CID' ,
                            'fuchiacode',
                            'agey',
                            'agem',
                            'Gender',
                            'Req_Doctor',
                            'visit_date',
                            'vdate',
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
                            'st_issue_date',
                            'created_by',
                            'updated_by'
                          ];
    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"CID","Pid");
    }
}
