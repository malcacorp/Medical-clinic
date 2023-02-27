@extends('template')

@section('content')
    @php
    $pais = App\Models\Pais::where('id',$paciente->id_pais)->first();
    $religion = App\Models\Religion::where('id',$paciente->id_religion)->first();
    $pato_personas = App\Models\patologia_persona::where('id_persona',$paciente->id)->get();
    $per_pros = App\Models\persona_prueba::where('id_persona',$paciente->id)->get();
    $med_pers = App\Models\medicamento_persona::where('id_persona',$paciente->id)->get();
    $aler_pers = App\Models\Alergia_Persona::where('id_persona',$paciente->id)->get();
    $citas =  App\Models\Cita::where('paciente_id',$paciente->id)->get();
    $inmu_pers = App\Models\Inmunizacion_Persona::where('id_persona',$paciente->id)->get();

    @endphp
 
            <div class="row">
                <div class="col-sm-7 col-6">
                    <h4 class="page-title">Perfil Paciente</h4>
                </div>
            </div>
            <div class="card-box profile-header">
                <div class="row">
                    <div class="col-md-12" style="min-height: 200px;">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#"><img class="avatar" src="{{ asset('imagenes/' . $paciente->ruta_foto) }}" alt=""></a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0">{{ $paciente->nombres }}
                                                {{ $paciente->apellido_paterno }}
                                            </h3>
                                            <div class="staff-id">DNI: {{ $paciente->dni }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <span class="title">Telefono:</span>
                                                <span class="text"><a href="#">{{ $paciente->telefono }}</a></span>
                                            </li>
                                            <li>
                                                <span class="title">Email:</span>
                                                <span class="text"><a href="#">{{ $paciente->email }}</a></span>
                                            </li>
                                            <li>
                                                <span class="title">Direccion:</span>
                                                <span class="text">{{ $paciente->direccion }} {{ $paciente->ciudad }}
                                                   @if( $paciente->id_pais!=null) {{ $pais->Nombre }}   @endif </span>
                                            </li>
                                            <li>
                                                <span class="title">Sexo:</span>
                                                <span class="text">@if( $paciente->id_sexo!=null) {{ $paciente->id_sexo }} @endif</span>
                                            </li>
                                            <li>
                                                <span class="title">Religion:</span>
                                                <span class="text">@if( $paciente->id_religion!=null){{ $religion->Nombre }} @endif</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-tabs">
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Patologias</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Medicamentos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Alergias</a></li> 
                    <li class="nav-item"><a class="nav-link" href="#bottom-tab4" data-toggle="tab">Citas</a></li> 
                    <li class="nav-item"><a class="nav-link" href="#bottom-tab5" data-toggle="tab">Pruebas</a></li> 
                    <li class="nav-item"><a class="nav-link" href="#bottom-tab6" data-toggle="tab">Inmunizaciones</a></li> 
                </ul>

                <div class="tab-content">
                    <div class="tab-pane show active" id="about-cont">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <div class="row justify-content-center text-center mb-4">
                                       
                                            <a  href="{{ route('paciente.patologia', $paciente ) }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Registrar Patologia</a>
                                   
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive ">
                                                <table class="table table-border table-striped custom-table datatable mb-0"
                                                    id="example">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th class="text-right">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pato_personas as $pato_persona)
                                                            @php $patologia = App\Models\Patologia::where('id',$pato_persona->id_patologia)->first();
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $patologia->nombre }}</td>
                                                                <td class="text-right">
                                                                    <div class="dropdown dropdown-action">
                                                                        <a href="#" class="action-icon dropdown-toggle"
                                                                            data-toggle="dropdown" aria-expanded="false"><i
                                                                                class="fa fa-ellipsis-v"></i></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('patologia.editar', $patologia->id) }}"><i
                                                                                    class="fa fa-pencil m-r-5"></i>
                                                                                Editar</a>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="bottom-tab2">
                        <div class="card-box">
                            <div class="row justify-content-center text-center mb-4">
                                       
                                <a href="{{ route('paciente.medicamento', $paciente ) }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Registrar Medicamento</a>
                       
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive ">
                                        <table class="table table-border table-striped custom-table datatable mb-0"
                                            id="example">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th class="text-right">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($med_pers as $med_per)
                                                    @php $medicamento =
                                                    App\Models\medicamento::where('id',$med_per->id_medicamento)->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $medicamento->nombre }}</td>
                                                        <td class="text-right">
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle"
                                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                                        class="fa fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('medicamento.editar', $medicamento->id) }}"><i
                                                                            class="fa fa-pencil m-r-5"></i> Editar</a>
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
                        </div>
                    </div>
                    <div class="tab-pane" id="bottom-tab3">
                        <div class="card-box">
                            <div class="row justify-content-center text-center mb-4">
                                       
                                <a  href="{{ route('paciente.alergia', $paciente ) }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Registrar Alergia</a>
                       
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive ">
                                        <table class="table table-border table-striped custom-table datatable mb-0"
                                            id="example">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th class="text-right">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($aler_pers as $aler_per)
                                                    @php $alergia =
                                                    App\Models\Alergia::where('id',$aler_per->id_alergia)->first(); @endphp
                                                    <tr>
                                                        <td>{{ $alergia->nombre }}</td>
                                                        <td class="text-right">
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle"
                                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                                        class="fa fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('alergia.editar', $alergia) }}"><i
                                                                            class="fa fa-pencil m-r-5"></i> Editar</a>
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
                        </div>
                    </div>
                    <div class="tab-pane" id="bottom-tab4">
                        <div class="card-box">
                            <div class="row justify-content-center text-center mb-4">
                                       
                                <a  href="{{ route('cita.add', $paciente ) }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Registrar Cita</a>
                       
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive ">
                                        <table class="table table-border table-striped custom-table datatable mb-0" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Departamento</th>
                                                    <th>Doctor</th>
                                                    <th>Fecha</th>
                                                    <th>Hora</th>
                                                    <th>Notas</th>
                                                    <th>Estado</th>
                                                    <th class="text-right">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach ($citas as $cita)
                                                    @php 
                                                    $departamento = App\Models\Departamento::where('id',$cita->departamento_id)->first(); 
                                                    $medico = App\Models\Persona::where('id',$cita->doctor_id)->first(); 
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $departamento->nombre }}</td>
                                                        <td>{{ $medico->nombres }}</td>
                                                        <td>{{ $cita->fecha }}</td>
                                                        <td>{{ $cita->hora }}</td>
                                                        <td>{{ $cita->notas }}</td>
                                                        <td><span @if( $cita->estado == 1 ) class="custom-badge status-green"> Activo</span></td> @else class="custom-badge status-red">Inactivo</span></td> @endif
                                                        <td class="text-right">
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle"
                                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                                        class="fa fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route( 'cita.edit', $cita->id ) }}"><i
                                                                            class="fa fa-pencil m-r-5"></i> Editar</a>
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
                        </div>
                    </div>
                    <div class="tab-pane" id="bottom-tab5">
                        <div class="card-box">
                            <div class="row justify-content-center text-center mb-4">
                                       
                                <a  href="{{ route('paciente.prueba',$paciente) }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Registrar Prueba</a>
                       
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive ">
                                        <table class="table table-border table-striped custom-table datatable mb-0" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Fecha</th>
                                                    <th>Comentario</th>
                                                    <th>Archivo</th>
                                                    <th class="text-right">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($per_pros as $per_pro)
                                                @php $prueba = App\Models\Prueba::where('id',$per_pro->id_prueba)->first();  @endphp
                                                <tr>
                                                    <td>{{ $prueba->nombre }}</td>
                                                    <td>{{ $per_pro->fecha }}</td>
                                                    <td>{{ $per_pro->comentario }}</td>
                                                    <td><img width="28" height="28" src="{{ asset('imagenes/' . $per_pro->ruta_archivo) }}" class="rounded-circle m-r-5" alt=""></td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="{{ route('prueba.editar',$prueba) }}"><i class="fa fa-pencil m-r-5"></i> Editar</a>
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
                        </div>
                    </div>

                <div class="tab-pane" id="bottom-tab6">
                        <div class="card-box">
                                <div class="row justify-content-center text-center mb-4">
                                           
                                    <a href="{{ route('paciente.inmunizacion', $paciente ) }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Registrar Inmunización</a>
                           
                            </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive ">
                                            <table class="table table-border table-striped custom-table datatable mb-0"
                                                id="example">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th class="text-right">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($inmu_pers as $inmu_per)
                                                        @php $inmunizacion =
                                                        App\Models\inmunizacion::where('id',$inmu_pers->id_inmunizacion)->first();
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $inmunizacion->nombre }}</td>
                                                            <td class="text-right">
                                                                <div class="dropdown dropdown-action">
                                                                    <a href="#" class="action-icon dropdown-toggle"
                                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                                            class="fa fa-ellipsis-v"></i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('inmunizacion.editar', $inmunizacion->id) }}"><i
                                                                                class="fa fa-pencil m-r-5"></i> Editar</a>
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
                            </div>
                </div>
                </div>
            </div>

@endsection
