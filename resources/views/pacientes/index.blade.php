@extends('template')

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Pacientes</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('anadir-paciente') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Registrar Paciente</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive ">
            <table class="table table-border table-striped custom-table datatable mb-0" id="example">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Documento de Identidad</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                    <tr>
                    <td><img width="28" height="28" src="{{ asset('public/imagenes/' . $paciente->ruta_foto) }}" class="rounded-circle m-r-5" alt=""> {{$paciente->apellido_paterno}} {{$paciente->apellido_materno}} {{$paciente->nombres}}</td>
                        <td>{{ $paciente->dni }}</td>
                        <td>{{ $paciente->direccion }}</td>
                        <td>{{ $paciente->telefono }}</td>
                        <td>{{ $paciente->email }}</td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('paciente.editar',$paciente) }}"><i class="fa fa-pencil m-r-5"></i> Editar</a>
                                    <a class="dropdown-item" href="{{ route('paciente.detalles',$paciente) }}"><i class="fa fa-eye m-r-5"></i> Detalles</a>
                                    <a class="dropdown-item" href="{{ route('paciente.patologia',$paciente) }}"><i class="fa fa-clipboard m-r-5"></i> Agregar Patologia</a>
                                    <a class="dropdown-item" href="{{ route('paciente.medicamento',$paciente) }}"><i class="fa fa-clipboard m-r-5"></i> Agregar Medicamento</a>
                                    <a class="dropdown-item" href="{{ route('paciente.alergia',$paciente) }}"><i class="fa fa-clipboard m-r-5"></i> Agregar Alergia</a>
                                    <a class="dropdown-item" href="{{ route('paciente.prueba',$paciente) }}"><i class="fa fa-clipboard m-r-5"></i> Agregar Examen</a>
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
<div id="delete_patient" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="assets/img/sent.png" alt="" width="50" height="46">
                <h3>¿Seguro que desea  Eliminar el paciente?</h3>
                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Cerrar</a>
                <form method="post" action="{{route('paciente.delete')}}">
                        @csrf
                        @method('delete')
                        <input hidden name="id" id="id_item" type="text"/>
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{asset('public/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
    function preparar(id){

        $('#id_item').val(id);
      
    }    
</script>  
@endsection
@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/dataTables.bootstrap4.min.css')}}">
@endsection