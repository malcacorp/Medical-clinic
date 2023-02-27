@extends('template')


@section('content')
<div class="row">
    <div class="col-sm-5 col-5">
        <h4 class="page-title">Departamentos</h4>
    </div>
    <div class="col-sm-7 col-7 text-right m-b-30">
    <a href="{{route('departamento.add')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Crear Departmento Medico</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @if (\Session::has('success'))
        <div class="alert alert-success">
            
                {!! \Session::get('success') !!}
           
        </div>
    @endif

    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre del departamento</th>
                        <th>Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departamentos as $departamento)
                    <tr>
                    <td>{{$departamento->id}}</td>
                        <td>{{$departamento->nombre}}</td>
                        <td><span class="custom-badge @if($departamento->estado=='ACTIVO')status-green @else status-red @endif">{{$departamento->estado}}</span></td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('departamento.edit',$departamento) }}"><i class="fa fa-pencil m-r-5"></i> Editar</a>
                                    <a class="dropdown-item" onclick="preparar({{$departamento->id}})" data-toggle="modal" data-target="#delete_department"><i class="fa fa-trash-o m-r-5"></i>Borrar</a>
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
<div id="delete_department" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="assets/img/sent.png" alt="" width="50" height="46">
                <h3>¿Seguro que desea borrar el Departmento?</h3>
                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Cerrar</a>
                <form method="post" action="{{route('departamento.delete')}}">
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
<script>
    function preparar(id){

        $('#id_item').val(id);
      
    }    
</script>    
@endsection