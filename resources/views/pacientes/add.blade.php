@extends('template')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Registrar Paciente</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form method="post" enctype="multipart/form-data" action="{{ route('paciente.store') }}">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nid">DNI <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="dni" onfocusout="ajax.buscar_cedula();">
                    </div>
                </div>    
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nombres <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nombres">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Apellido Paterno</label>
                        <input class="form-control" type="text" name="apellido_materno">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Apellido Materno</label>
                        <input class="form-control" type="text" name="apellido_paterno">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Usuario <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="login">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Contrase&ntilde;a</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Avatar</label>
                        <div class="profile-upload">
                            <div class="upload-img">
                                <img alt="" src="{{ asset('public/assets/img/user.jpg') }}">
                            </div>
                            <div class="upload-input">
                                <input type="file" id="ruta_foto"  name="ruta_foto" class="form-control" >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Correo <span class="text-danger">*</span></label>
                        <input class="form-control" type="email" name="email">
                    </div>
                </div>
        
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Fecha de Nacimiento</label>
                        <div class="cal-icon">
                            <input type="text" class="form-control datetimepicker" name="fecha_nac">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group gender-select">
                        <label class="gen-label">Sexo:</label>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" name="sexo" class="form-check-input" value="Masculino">Masculino
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" name="sexo" class="form-check-input" value="Femenino">Femenino
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Dirección de Nacimiento</label>
                                <textarea class="form-control" rows="3" name="direccion_nac"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>País de Nacimiento</label>
                                <select class="form-control select" name="id_pais_nac">
                                    @foreach($paises as $pais)
                                        <option value='{{ $pais->id }}'>{{ $pais->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>Ciudad de Nacimiento</label>
                                <input type="text" class="form-control" name="ciudad_nac">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>Estado/Provincia de Nacimiento</label>
                                <select class="form-control select" name="id_estado_nac">
                                    @foreach($estados as $estado)
                                        <option value='{{ $estado->id }}'>{{ $estado->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Dirección de Residencia</label>
                                <textarea class="form-control" rows="3" name="direccion"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label>País de Residencia</label>
                                <select class="form-control select" name="id_pais">
                                    @foreach($paises as $pais)
                                        <option value='{{ $pais->id }}'>{{ $pais->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label>Ciudad de Residencia</label>
                                <input type="text" class="form-control" name="ciudad">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label>Estado/Provincia</label>
                                <select class="form-control select" name="id_estado">
                                    @foreach($estados as $estado)
                                        <option value='{{ $estado->id }}'>{{ $estado->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label>Codigo Postal</label>
                                <input type="text" class="form-control" name="zip">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Telefono </label>
                        <input class="form-control" type="text" name="telefono">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Documento</label>
                        <div class="profile-upload">
                            <div class="upload-img">
                                <img alt=""  src="{{ asset('public/assets/img/user.jpg') }}">
                            </div>
                            <div class="upload-input">
                                <input type="file" id="ruta_doc_identidad" name="ruta_doc_identidad" class="form-control" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="grado_instruccion">Grado de Instruccion</label>
                    <input type="num" class="form-control" name="grado_instruccion">
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="id_colegio">Colegio Profesional</label>
                        <select class="form-control select" name="id_colegio">
                            @foreach($colegios as $colegios)
                                <option value='{{ $colegios->id }}'>{{ $colegios->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label for="num_colegiatura">Numero de Colegiatura</label>
                    <input type="number" class="form-control" name="num_colegiatura">
                </div>
                <div class="form-group col-sm-3">
                    <label class="display-block">Es Empleado</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="es_empleado_boolean" id="patient_active" value="1" checked>
                        <label class="form-check-label" for="patient_active">
                        Si
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="es_empleado_boolean" id="patient_inactive" value="0">
                        <label class="form-check-label" for="patient_inactive">
                        No
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="id_grupo_sanguineo">Grupo Sanguineo</label>
                        <select class="form-control select" name="id_grupo_sanguineo">
                            @foreach($grupoSanguineo as $grupoSanguineo)
                                <option value='{{ $grupoSanguineo->id }}'>{{ $grupoSanguineo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="display-block">Donante de Organos</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="donacion_organos" id="donor_active" value="1" checked>
                            <label class="form-check-label" for="donor_active">
                            Si
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="donacion_organos" id="donor_inactive" value="0">
                            <label class="form-check-label" for="donor_inactive">
                            No
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="num_colegiatura">ORCID</label>
                    <input type="number" class="form-control" name="ORCID">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="id_estado_civil">Estado Civil</label>
                        <select class="form-control select" name="id_estado_civil">
                            @foreach($estadocivil as $estadocivil)
                                <option value='{{ $estadocivil->id }}'>{{ $estadocivil->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="id_etnias">Etnias</label>
                        <select class="form-control select" name="id_etnias">
                            @foreach($etnias as $etnias)
                                <option value='{{ $etnias->id }}'>{{ $etnias->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="id_religion">Religion</label>
                        <select class="form-control select" name="id_religion">
                            @foreach($religion as $religion)
                                <option value='{{ $religion->id }}'>{{ $religion->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="display-block">Estado</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="patient_active" value="1" checked>
                    <label class="form-check-label" for="patient_active">
                    Activo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="patient_inactive" value="0">
                    <label class="form-check-label" for="patient_inactive">
                    Inactivo
                    </label>
                </div>
            </div>
            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn">Crear Paciente</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('public/assets/js/select2.min.js')}}"></script>
<script src="{{ asset('public/assets/js/moment.min.js')}}"></script>
<script src="{{ asset('public/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap-datetimepicker.min.css')}}">
@endsection