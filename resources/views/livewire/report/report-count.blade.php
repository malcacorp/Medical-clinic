<div>
  <x-slot name="header">
     <h2 class="ms-4 h3">
        {{ __('Number of Medical assessment per week') }}
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
                                <th> {{ __('Number of patients2') }} </th>
                            </thead>
                        </tr>  
                        <tbody>    
                                
                                @foreach ($assessments as $item )
                                    <tr>
                                        <thead>
                                            <td> {{ $item -> year}}</td>
                                            <th> {{ $item -> week}} </th>
                                            <th> {{ $item -> patient_count}} </th>
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

