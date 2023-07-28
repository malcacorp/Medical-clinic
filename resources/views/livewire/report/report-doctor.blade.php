<div>
  <x-slot name="header">
     <h2 class="ms-4 h3">
        {{ __('List of care by doctor') }}
     </h2>
    

    <div class=card>
        <div class=card-body>
            <h5 class="card-title"> DOCTOR REPORT  ()</h5> 
            <p class="card-text">
                <div class="table table-responsive">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <thead>
                                <th> Id Employee</th>
                                <th> Patient attended</th>
                                <th> Medical condition </th>
                                <th> Date of Attention </th>
                            </thead>
                         </tr>   
                        <tbody>    
                                  
                                         @foreach ($atenciones2 as $item2 )                                                                                             
                                            <tr>
                                                <thead>
                                                    <td> {{ $item2 -> doctor_id}}</td>
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
    <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>ID=2 FREDDY ACEVEDO, ID=3 LUISA HERNáNDEZ</span>
                    </div>
                </div>
    </footer>  
    
</div>

