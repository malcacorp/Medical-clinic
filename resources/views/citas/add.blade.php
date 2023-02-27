@extends('template')


@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Registrar Cita </h4>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form method="POST" action="{{ route('cita.save') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>ID Cita </label>
                    <input class="form-control" type="text" value="APT-{{$next}}" readonly="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre del paciente</label>
                        <select class="select" name='paciente_id'>
                            <option>Select</option>
                            @foreach($pacientes as $paciente)
                                <option value='{{ $paciente->id }}'>{{ $paciente->nombres }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Departmento</label>
                        <select class="select" name="departamento_id">
                            <option>Seleccion</option>
                            @foreach($departamentos as $departamento)
                                <option value='{{ $departamento->id }}' >{{ $departamento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="select" name="doctor_id">
                            <option>Select</option>
                            @foreach($doctores as $doctor)
                                <option value='{{ $doctor->id }}'> {{ $doctor->nombres }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Fecha</label>
                        <div class="cal-icon">
                            <input type="text" class="form-control datetimepicker" name="fecha">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Hora</label>
                        <div class="time-icon">
                            <input type="text" class="form-control" id="datetimepicker3" name="hora">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Notas</label>
                <textarea cols="30" rows="4" class="form-control" name="notas"></textarea>
            </div>
            <div class="form-group">
                <label class="display-block">Cita Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="estado" id="product_active" value="1" checked>
                    <label class="form-check-label" for="product_active">
                    Activo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="estado" id="product_inactive" value="0">
                    <label class="form-check-label" for="product_inactive">
                    Inactivo
                    </label>
                </div>
            </div>
            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn">Crear Cita</button>
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