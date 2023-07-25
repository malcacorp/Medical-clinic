<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div>
  <x-slot name="header">
     <h2 class="ms-4 h3">
        {{ __('Patients') }}
     </h2>

    <div class=card>
        <h5 class="card-header">     Report   </h5> 
        <div class=card-body>
            <h5 class="card-title"> Patients Attended</h5> 
            <p class="card-text">
                <div class="table table-responsive">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <thead>
                                <th> Firt Name </th>
                                <th> Last Name </th>
                                <th> email </th>
                                <th> phone_number </th>
                                <th> Medical condition </th>
                                <th> Date </th>
                            </thead>
                        </tr>   
                        <tbody>    
                                
                                @foreach ( $reportpacients as $item )
                                    <tr>
                                        <thead>
                                            <td> {{ $item -> first_name}}</td>
                                            <th> {{ $item -> last_name}} </th>
                                            <th> {{ $item -> email}} </th>
                                            <th> {{ $item -> phone_number}} </th>
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
