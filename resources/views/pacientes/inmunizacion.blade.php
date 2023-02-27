@extends('template')

@section('content')

<div class="row">
    <div class="col-lg-7 offset-lg-3">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form method="post" enctype="multipart/form-data" action="{{ route('paciente.inmunizacion.store') }}">
            @csrf
            <input type="hidden" value="{{ $paciente }}" name="id_persona">
            <div class="col-sm-9">
                <p>Registro de Inmunizaciones Paciente</p>
                <div class="form-group">
                    <label for="id_colegio">Inmunizacion</label>
                    <select class="form-control select" name="id_inmunizacion">
                        @foreach($inmunizaciones as $inmunizacion)
                            <option value='{{ $inmunizacion->id }}'>{{ $inmunizacion->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Fecha de Administración</label>
                    <div class="cal-icon">
                        <input type="text" class="form-control datetimepicker" name="fecha_ini">
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Fecha de Vencimiento</label>
                    <div class="cal-icon">
                        <input type="text" class="form-control datetimepicker" name="fecha_fin">
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label for="id_colegio">Fuente de información</label>
                    <select class="form-control select" name="fuente">
                            <option value='NE'> No Especificado </option>
                            <option value='NUEVA'>Nueva inmunización</option>
                            <option value='AGENCIAP'> Agencia pública </option>
                            <option value='TARJETA'>Tarjeta de vacunación</option>
                            <option value='HC'> Historia Clínica </option>
                            <option value='PADRES'>Padres del paciente</option>
                            <option value='PACIENTE'>Paciente</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label for="id_colegio">Estatus</label>
                    <select class="form-control select" name="estatus">
                            <option value='NE'> No Especificado </option>
                            <option value='COMPLETO'> Completo</option>
                            <option value='NOADM'> No administrado </option>
                            <option value='PARCIAL'> Parcialmente administrado </option>
                            <option value='RECHAZADO'> Rechazado </option>
                    </select>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label for="comentario">Comentarios<span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="3" name="comentario"></textarea>
                </div>
            </div>
            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn">Guardar Medicamento</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/select2.min.js')}}"></script>
<script src="{{ asset('assets/js/moment.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endsection