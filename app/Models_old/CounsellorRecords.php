<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounsellorRecords extends Model
{
    use HasFactory;
    protected $fillable=
    [
                            "Clinic Code",
                            'Pid',
                            "FuchiaID",
                            "PrEPCode",
                            "Gender",
                            "Agey",
                            "Agem",

                            "Counselling Date",
                            "Counsellor",
                            "Main Risk",
                            "Sub Risk",

                            "Pre",
                            "Post",
                            "HTSdone",
                            "Reason",
                            "Status",
                            "PrEP",
                            "PrEP Status",
                            "C1",
                            "C2",
                            "C3",
                            "ADH",
                            "Child under15 Adoles",
                            "Child under15 Dis",
                            "Child under15 ADH",
                            "MMT",
                            "IPT",
                            "TB",
                            "NCD",
                            "ANC",
                            "PFA",
                            "PHQ9",
                            "Other",
                            "EAC",
                            "HMT",
                            "C P case",
                            "PMTCT",
                          ];
}
