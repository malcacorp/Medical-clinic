@extends('template')


@section('content')
@php
$paciente = App\Models\Persona::where('id',$cita->paciente_id)->first();
$doctor = App\Models\Persona::where('id',$cita->doctor_id)->first();
$dep_p = App\Models\Departamento_Persona::where('id_persona',$cita->doctor_id)->first();
$dep = App\Models\Departamento::where('id',$dep_p->id_departamento)->first();
@endphp
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Editar Cita </h4>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form method="POST" action="{{ route('cita.update', $cita->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>ID Cita </label>
                    <input class="form-control" type="text" value="APT-{{$cita->id}}" readonly="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre del paciente</label>
                        <select class="select" aria-readonly="">
                        <option>{{$paciente->nombres}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Departmento</label>
                        <select class="select" aria-readonly="">
                            <option>{{$dep->nombre}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="select" aria-readonly="">
                            <option>{{$doctor->nombres}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Fecha</label>
                        <div class="cal-icon">
                        <input type="text" class="form-control datetimepicker" name="fecha" value="{{$cita->fecha}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Hora</label>
                        <div class="time-icon">
                            <input type="text" class="form-control" id="datetimepicker3" name="hora" value="{{$cita->hora}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Notas</label>
                <textarea cols="30" rows="4" class="form-control" name="notas" >{{$cita->notas}}</textarea>
            </div>
            <div class="form-group">
                <label class="display-block">Cita Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="estado" id="product_active" value="1" @if ($cita->estado == 1) checked @endif>
                    <label class="form-check-label" for="product_active">
                    Activo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="estado" id="product_inactive" value="0" @if ($cita->estado == 0) checked @endif>
                    <label class="form-check-label" for="product_inactive">
                    Inactivo
                    </label>
                </div>
            </div>
            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn">Actualizar Cita</button>
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