@extends('template')


@section('content')
@php 
$persona = App\Models\Persona::where('id',Auth::user()->id)->get()->first(); 
$rol = $persona->rol;
if($rol == 'PACIENTE'){
    $citas = $citas->where('paciente_id',$persona->id);
}
@endphp
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Citas</h4>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
    <a href="{{ route('cita.add')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Crear Cita</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table">
                <thead>
                    <tr>
                        <th>Cita ID</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Department</th>
                        <th>Cita Date</th>
                        <th>Cita Time</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                    <tr>
                    <td>APT-{{ $cita->id }}</td>
                        @php
                            $paciente = App\Models\Persona::where('id',$cita->paciente_id)->first();
                            $doctor = App\Models\Persona::where('id',$cita->doctor_id)->first();
                            $dep_p = App\Models\Departamento_Persona::where('id_persona',$cita->doctor_id)->first();
                            $dep = App\Models\Departamento::where('id',$dep_p->id_departamento)->first();
                        @endphp
                        <td><img width="28" height="28" src="{{asset('imagenes/'.$paciente->ruta_foto)}}" class="rounded-circle m-r-5" alt=""> {{ $paciente->nombres }} </td>
                        <td>{{ $doctor->nombres }}</td>
                        <td>{{ $dep->nombre }}</td>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td><span @if( $cita->estado == 1 ) class="custom-badge status-green"> Activo</span></td> @else class="custom-badge status-red">Inactivo</span></td> @endif
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route( 'cita.edit', $cita->id ) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ route( 'consultas', $cita->id ) }}"><i class="fa fa-pencil m-r-5"></i> Consulta</a>
                                    <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_Cita"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
<div id="delete_Cita" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="assets/img/sent.png" alt="" width="50" height="46">
                <h3>Are you sure want to delete this Appointment?</h3>
                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection