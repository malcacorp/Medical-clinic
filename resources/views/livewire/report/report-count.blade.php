<div>
  <x-slot name="header">
     <h2 class="ms-4 h3">
        {{ __('Number of Patients attended at per week') }}
     </h2>


    <div class=card>
          <div class=card-body>
          <div class="row">
                <div class="col-sm-2 m-auto">
                    <div class="card p-3 bg-primary" style="margin: 10px 0;">
                        <h5 class="text-center text-white">{{ __("Total Patients Dr. Freddy:") }}</h5>
                        <h5 class="text-center text-white">{{ $employee_Freddy  }}</h5>
                       
                    </div>
                </div>
                <div class="col-sm-2 m-auto">
                    <div class="card p-3 bg-primary" style="margin: 10px 0;">
                        <h5 class="text-center text-white">{{ __("Total Patients Dr. Surmer:") }}</h5>
                        <h5 class="text-center text-white">{{$employee_Surmen }}</h5>
                    </div>
                </div>
                <div class="col-sm-2 m-auto">
                    <div class="card p-3 bg-primary" style="margin: 10px 0;">
                        <h5 class="text-center text-white">{{ __("Total Patients Dr. Luisa:" ) }}</h5>
                        <h5 class="text-center text-white">{{$employee_Luisa }}</h5>
                    </div>
                </div>
                <div class="col-sm-2 m-auto">
                    <div class="card p-3 bg-primary" style="margin: 10px 0;">
                        <h5 class="text-center text-white">{{ __("Total  Patients Dr. Neymary: ") }}</h5>
                        <h5 class="text-center text-white">{{ $employee_Ney }}</h5>
                        
                    </div>
                </div>
            </div>
            </div>


            <p class="card-text">
            <div class="row">
     

                <div class="table table-responsive">
                    <table class="table table-sm table-bordered">
                        <tr>
                           
                            <thead>
                                <th> {{ __('Year') }} </th>
                                <th> {{ __('Week') }} </th>
                                <th> {{ __('Doctor ID') }} </th>
                                <th> {{ __('Total Patients') }} </th>

                            </thead>
                        </tr>  
                        <tbody>    
                                
                              
                                @foreach ($assessments as $item2)
                                        <tr>
                                            <thead>
                                                <td> {{ $item2 -> year}}</td>
                                                <td> {{ $item2 -> week }}</td>
                                                <th> {{ $item2-> first_name }} </th>
                                                <th> {{ $item2 -> patient_count}} </th>
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

