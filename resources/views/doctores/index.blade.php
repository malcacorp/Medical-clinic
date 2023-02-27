@extends('template')


@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Medicos</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('medico.add')}}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Registrar Doctor </a>
    </div>
</div>
<div class="row doctor-grid">
    @foreach($doctores as $doctor)
    <div class="col-md-4 col-sm-4  col-lg-3">
        <div class="profile-widget">
            <div class="doctor-img">
                <a class="avatar" href="#"><img alt="" src="{{asset('public/imagenes/'.$doctor->ruta_foto)}}"></a>
            </div>
            <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="edit-doctor.html"><i class="fa fa-pencil m-r-5"></i> Editar</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_doctor"><i class="fa fa-trash-o m-r-5"></i> Borrar</a>
                </div>
            </div>
        <h4 class="doctor-name text-ellipsis"><a href="profile.html">{{$doctor->apellido_paterno}} {{$doctor->nombres}} </a></h4>
            @php 
                $var = App\Models\Departamento_Persona::where('id_persona',$doctor->id)->first();

            @endphp
   
            <div class="doc-prof">@if($var){{$var->departamento->nombre}}@else Sin departamento @endif</div>
            <div class="user-country">
                <i class="fa fa-stethoscope"></i> @if($var->especialidad){{$var->especialidad}}@else Sin especialidad @endif
            </div>
        </div>
    </div>
    @endforeach

</div>
<div class="row">
    <div class="col-sm-12">
        <div class="see-all">
            <a class="see-all-btn" href="javascript:void(0);">Cargar más </a>
        </div>
    </div>
</div>
@endsection