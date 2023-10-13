<div>
  <x-slot name="header">
     <h2 class="ms-4 h3">
        {{ __('Number of Patients attended at per week') }}
     </h2>


    <div class=card>
          <div class=card-body>
            <p class="card-text">
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

