<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div>
     <x-slot name="header">
       
    <div class=card>
        <h5 class="card-header">     {{ __('Report') }}   </h5> 
        <div class=card-body>
            <h5 class="card-title"> {{ __('Patients Attended') }}</h5> 
            <p class="card-text">
                <div class="table table-responsive">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <thead>
                                <th> {{ __('First name') }} </th>
                                <th> {{ __('Last name') }} </th>
                                <th> {{ __('email') }} </th>
                                <th> {{ __('Phone number') }} </th>
                                <th> {{ __('Medical Condition') }} </th>
                                <th> {{ __('Date') }} </th>
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
