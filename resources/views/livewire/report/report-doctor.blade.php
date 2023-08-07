<div>
  <x-slot name="header">
     <h2 class="ms-4 h3">
        {{ __('List of care by doctor') }}
     </h2>
    

    <div class=card>
        <div class=card-body>
            
            <p class="card-text">
                <div class="table table-responsive">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <thead>
                                <th> {{ __('Doctor Name') }} </th>
                                <th> {{ __('Patient Treat') }}</th>
                                <th> {{ __('Medical Condition') }}</th>
                                <th> {{ __('Date of Attention') }} </th>
                            </thead>
                         </tr>   
                        <tbody>    
                                  
                        @foreach ($medicalAssessments as $item2 )                                                                                             
                        <tr>
                            <thead>
                                <td> {{ $item2->employee!=null ? $item2->employee->first_name : ''}}</td>
                                <td> {{ $item2 -> patient_id}}</td>
                                <th> {{ $item2 -> medical_condition}} </th>
                                <th> {{ $item2-> created_at}} </th>
                            </thead>
                        </tr>
                        @endforeach
                                                             
                              
                        </tbody>  
                    </table>
                </div>
           
            </p >
        </div>
    </div>                 
</div>

