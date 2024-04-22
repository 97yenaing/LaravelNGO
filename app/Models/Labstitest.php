<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labstitest extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'clinic code',
      'CID',
      'fuchiacode',
      'agey',
      'agem',
      'Gender',
      'Req_Doctor',
      'visit_date',
      'vdate',
      'Type Of Patient',
      'Patient Type Sub',
      'Wet Mount clue cell',
      'Wet Mount Trichomonas',
      'Wet Mount candida',
      'wetoth',
      'urethra WBC',
      'Urethra diplococci intra-cell',
      'Urethra diplococci extra-cell',
      'Urethra Candida',
      'uoth',
      'Fornix Clue Cells',
      'Fornix WBC',
      'Fornix diplococci intra-cell',
      'Fornix diplococci extra-cell',
      'Fornix Candida',
      'pfother',
      'Endo cervix WBC',
      'Endo cervix diplococci intra-cell',
      'Endo cervix diplococci extra-cell',
      'Endo cervix Candida',
      'eother',
      'Rectum WBC',
      'Rectum diplococci intra-cell',
      'Rectum diplococci extra-cell',
      'rother',
      'First Per Urine',
      'Epithelial cells',
      'PMNL cells',

      'First Per Urine Diplococci Intra-Cell',
      'First Per Urine Diplococci Extra-Cell',
      'fpu_oth',
      'Lab Techanician',
      'idate',
      'visitID',
      'Other Bacteria',

      'Clue cells result',
      'PMNL result',
      'trichomonas result',
      'diplococci intra cell result',
      'diplococci extra cell result',
      'spermatozoites result',
      'candida result',

      'created_by',
        'updated_by'
      ];
      protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"CID","Pid");
    }

}
