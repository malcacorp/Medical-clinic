<div>
  <x-slot name="header">
     <h2 class="ms-4 h3">
        {{ __('Patient') }}
     </h2>


    <div class=card>
        <h5 class="card-header">   Report   </h5> 
        <div class=card-body>
            <h5 class="card-title"> MEDICAL ASSESMENT </h5> 
            <p class="card-text">
                <div class="table table-responsive">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <thead>
                                <th> Id </th>
                                <th> Medical condition </th>
                                <th> Fecha de Atencion </th>
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

