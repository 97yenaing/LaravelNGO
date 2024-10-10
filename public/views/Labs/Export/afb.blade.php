<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import Export Excel </title>
    <style>
    table {
      border-collapse: collapse;
      font-size: 12px;
    }

    th, td {
      border: 2px solid black;
      height:50px;
    }
  </style>
</head>

<body>
    <div class="container mt-5 text-center">
        <!-- <form action="{{ route('lab_export_link') }}" method="POST" > -->
          <form action="{{ route('counsellor_export') }}"  method="POST" >
            @csrf
           
            <table>
              <thead>
                <tr>  
                  <th style="background-color:#a6a6a6;">Clinic Code           </th>
                  <th style="background-color:#a6a6a6;">General ID                 </th>
                  <th style="background-color:#a6a6a6;">Fuchia ID            </th>
                  <th style="background-color:#a6a6a6;">Register Year</th>
                  <th style="background-color:#a6a6a6;">Register Agey</th>
                  <th style="background-color:#a6a6a6;">Register Agem(Month)</th>
                  <th style="background-color:#a6a6a6;">Current Agey</th>
                  <th style="background-color:#a6a6a6;">Current Agem(Month)</th>
                  <th style="background-color:#a6a6a6;">Gender                </th>
                  <th style="background-color:#a6a6a6;">Requested Doctor      </th>
                  <th style="background-color:#a6a6a6;">Visit Date            </th>
                  <th style="background-color:#a6a6a6;">Main Risk          </th>
                  <th style="background-color:#a6a6a6;">Sub Risk      </th>
                  <th style="background-color:#a6a6a6;">Patient's Name          </th>
                  <th style="background-color:#a6a6a6;">Patient Address       </th>
                  <th style="background-color:#a6a6a6;">Previous TB           </th>
                  <th style="background-color:#a6a6a6;">HIV Status            </th>
                  <th style="background-color:#a6a6a6;">Reason_for_exam       </th>
                  <th style="background-color:#a6a6a6;">Patient Type           </th>
                  <th style="background-color:#a6a6a6;">Follow Up Month          </th>
                  <th style="background-color:#a6a6a6;">Specimen type           </th>
                  <th style="background-color:#a6a6a6;">oth_spe_ty            </th>

                  <th style="background-color:#a6a6a6;">Slide Number 1          </th>
                  <th style="background-color:#a6a6a6;">Specimen receive date 1     </th>
                  <th style="background-color:#a6a6a6;">Visual Appearance 1          </th>
                  <th style="background-color:#a6a6a6;">Result 1           </th>
                  <th style="background-color:#a6a6a6;">Slide Grading, 1       </th>

                  <th style="background-color:#a6a6a6;">Slide Number 2         </th>
                  <th style="background-color:#a6a6a6;">Specimen receive date 2     </th>
                  <th style="background-color:#a6a6a6;">Visual Apperance 2          </th>
                  <th style="background-color:#a6a6a6;">Result 2           </th>
                  <th style="background-color:#a6a6a6;">Slide grading 2       </th>

                  <th style="background-color:#a6a6a6;">Lab technician        </th>
                  <th style="background-color:#a6a6a6;">Issue date       </th>
                          
                </tr>
              </thead>

              <tbody>
                @foreach($users as $index => $value)
                <tr> 
                    <td style="width:50px;">{{ $value['Clinic Code'] }}</td>
                    <td style="width:100px;">{{ $value['CID'] }}</td>
                    <td style="width:100px;">{{ $value['fuchiacode'] }}</td>
                    <td style="width:80px;">{{ $value['Reg year'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agey'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agem'] }}</td>
                    <td style="width:80px;">{{ $value['Current Agey'] }}</td>
                   <td style="width:80px;">{{ $value['Current Agem'] }}</td>
                    <td style="width:100px;">{{ $value['Gender'] }}</td>
                    <td style="width:100px;">{{ $value['Req_Doctor'     ] }}</td>
                    <td style="width:100px;">{{ $value['vdate'] }}</td>
                    <td style="width:100px;">{{ $value['Patient_Type'] }}</td>
                    <td style="width:100px;">{{ $value['Patient Type Sub'     ] }}</td>
                    <td style="width:100px;">{{ $value['Name'] }}</td>
                    <td style="width:250px;">{{$value['Quarter'].','.$value['Township'].','.$value['Region']}}</td>
                    <td style="width:100px;">{{ $value['Previous_TB'          ] }}</td>
                    <td style="width:100px;">{{ $value['HIV_status'           ] }}</td>
                    <td style="width:100px;">{{ $value['reason_for_exam'      ] }}</td>
                    <td style="width:100px;">{{ $value['afb_Pt_type'          ] }}</td>
                    <td style="width:100px;">{{ $value['follow_up_mt'         ] }}</td>
                    <td style="width:100px;">{{ $value['speci_type'           ] }}</td>
                    <td style="width:100px;">{{ $value['oth_spe_ty'           ] }}</td>

                    <td style="width:100px;">{{ $value['slide_num_1'          ] }}</td>
                    <td style="width:100px;">{{ $value['speci_receive_dt1'    ] }}</td>
                    <td style="width:100px;">{{ $value['visual_app_1'         ] }}</td>
                    <td style="width:100px;">{{ $value['afb_result1'          ] }}</td>
                    <td style="width:100px;">{{ $value['slide1_grading1'      ] }}</td>
                    

                    <td style="width:100px;">{{ $value['slide_num_2'          ] }}</td>
                    <td style="width:100px;">{{ $value['speci_receive_dt2'    ] }}</td>
                    <td style="width:100px;">{{ $value['visual_app_2'         ] }}</td>
                    <td style="width:100px;">{{ $value['afb_result2'          ] }}</td>
                    <td style="width:100px;">{{ $value['slide2_grading2'      ] }}</td>

                    <td style="width:100px;">{{ $value['afb_lab_techca'       ] }}</td>
                    <td style="width:100px;">{{ $value['afb_issue_date'       ] }}</td>
                          


                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>
