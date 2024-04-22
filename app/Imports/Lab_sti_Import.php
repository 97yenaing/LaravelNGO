<?php

namespace App\Imports;

use App\Models\Labstitest;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class Lab_sti_Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $table="General";
        return new Labstitest([

          'clinic code'                   =>$row[0],
          'CID'                           =>$row[1],
          'fuchiacode'                    =>$row[2],
          'agey'                          =>$row[3],
          'agem'                          =>$row[4],
          'Gender'                        =>Crypt::encrypt_light($row[5],$table),
          'Requested Doctor'              =>Crypt::encrypt_light($row[6],$table),
          'Requested Doctor New'          =>Crypt::encrypt_light($row[7],$table),
          'visit_date'                    =>$row[8],
          'Type Of Patient'               =>Crypt::encrypt_light($row[9],$table),
          'Patient Type Sub'              =>Crypt::encrypt_light($row[10],$table),
          'Wet Mount clue cell'           =>Crypt::encrypt_light($row[11],$table),
          'Wet Mount Trichomonas'         =>Crypt::encrypt_light($row[12],$table),
          'Wet Mount candida'             =>Crypt::encrypt_light($row[13],$table),
          'wetoth'                        =>Crypt::encrypt_light($row[14],$table),
          'urethra WBC'                   =>Crypt::encrypt_light($row[15],$table),
          'Urethra diplococci intra-cell' =>Crypt::encrypt_light($row[16],$table),
          'Urethra diplococci extra-cell' =>Crypt::encrypt_light($row[17],$table),
          'Urethra Candida'               =>Crypt::encrypt_light($row[18],$table),
          'uoth'                          =>Crypt::encrypt_light($row[19],$table),
          'Fornix Clue Cells'             =>Crypt::encrypt_light($row[20],$table),
          'PMNL WBC'                      =>Crypt::encrypt_light($row[21],$table),
          'Fornix diplococci intra-cell'  =>Crypt::encrypt_light($row[22],$table),
          'Fornix diplococci extra-cell'  =>Crypt::encrypt_light($row[23],$table),
          'Fornix Candida'                =>Crypt::encrypt_light($row[24],$table),
          'pfother'                       =>Crypt::encrypt_light($row[25],$table),
          'Endo cervix WBC'               =>Crypt::encrypt_light($row[26],$table),
          'Endo cervix diplococci intra-cell'=>Crypt::encrypt_light($row[27],$table),
          'Endo cervix diplococci extra-cell'=>Crypt::encrypt_light($row[28],$table),
          'Endo cervix Candida'              =>Crypt::encrypt_light($row[29],$table),
          'eother'                           =>Crypt::encrypt_light($row[30],$table),
          'Rectum WBC'                       =>Crypt::encrypt_light($row[31],$table),
          'Rectum diplococci intra-cell'     =>Crypt::encrypt_light($row[32],$table),
          'Rectum diplococci extra-cell'     =>Crypt::encrypt_light($row[33],$table),
          'rother'                           =>Crypt::encrypt_light($row[34],$table),
          'First Per Urine'                  =>Crypt::encrypt_light($row[35],$table),
          'Epithelial cells'                 =>Crypt::encrypt_light($row[36],$table),
          'PMNL cells'                       =>Crypt::encrypt_light($row[37],$table),
          'First Per Urine Diplococci Intra-Cell'=>Crypt::encrypt_light($row[38],$table),
          'First Per Urine Diplococci Extra-Cell'=>Crypt::encrypt_light($row[39],$table),
          'fpu_oth'                              =>Crypt::encrypt_light($row[40],$table),
          'Lab Techanician'                      =>Crypt::encrypt_light($row[41],$table),
          'idate'                                =>$row[42],
          'visitID'                              =>$row[43],
          'Other Bacteria'                  =>Crypt::encrypt_light($row[44],$table),
          // 'Clue cells result'                    =>$row[44],
          // 'PMNL result'                          =>$row[45],
          // 'trichomonas result'                   =>$row[46],
          // 'diplococci intra cell result'         =>$row[47],
          // 'diplococci extra cell result'         =>$row[48],
          // 'spermatozoites result'                =>$row[49],
          // 'candida result'                       =>$row[50],
        ]);
    }
}
