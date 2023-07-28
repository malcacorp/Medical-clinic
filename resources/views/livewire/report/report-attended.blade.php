<div>
  <x-slot name="header">
     <h2 class="ms-4 h3">
        {{ __('List of medical assessment') }}
     </h2>


    <div class=card>
          <div class=card-body>
            <h5 class="card-title"> MEDICAL ASSESSMENT </h5> 
            <p class="card-text">
                <div class="table table-responsive">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <thead>
                                <th> Patient id </th>
                                <th> Medical Assessment </th>
                                <th> Date of service </th>
                            </thead>
                        </tr>   
                        <tbody>    
                                
                                @foreach ($resultados as $item )
                                    <tr>
                                        <thead>
                                            <td> {{ $item -> id}}</td>
                                            <th> {{ $item -> medical_condition}} </th>
                                            <th> {{ $item -> created_at}} </th>
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

