@extends('template')

@section('content')

<div class="row">
    <div class="col-lg-7 offset-lg-3">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form method="post" enctype="multipart/form-data" action="{{ route('paciente.medicamento.store') }}">
            @csrf
            <input type="hidden" value="{{ $paciente }}" name="id_persona">
            <div class="col-sm-9">
                <p>Registro de Medicamentos Paciente</p>
                <div class="form-group">
                    <label for="id_colegio">Medicamento</label>
                    <select class="form-control select" name="id_medicamento">
                        @foreach($medicamentos as $medicamento)
                            <option value='{{ $medicamento->id }}'>{{ $medicamento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Fecha de Inicio</label>
                    <div class="cal-icon">
                        <input type="text" class="form-control datetimepicker" name="fecha_ini">
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Fecha de Fin</label>
                    <div class="cal-icon">
                        <input type="text" class="form-control datetimepicker" name="fecha_fin">
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label for="id_colegio">Ocurrencia</label>
                    <select class="form-control select" name="ocurrencia">
                            <option value='NE'> No Especificado </option>
                            <option value='PRIMERA'> Primera vez</option>
                            <option value='TEMPRANA'> Temprana (Menor a 2 meses) </option>
                            <option value='TARDIA'> Tardia (De 2 a 12 meses)</option>
                            <option value='RETRAZADA'> Retrazada </option>
                            <option value='CRONICA'>Cronica </option>
                    </select>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label for="comentario">Comentarios<span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="3" name="comentario"></textarea>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label for="id_colegio">Desenlace</label>
                    <select class="form-control select" name="desenlace">
                            <option value='NE'> No Especificado </option>
                            <option value='CURADO'> Curado</option>
                            <option value='MEJORADO'> Mejorado </option>
                            <option value='PEOR'> Peor </option>
                            <option value='PENDIENTE'> Pendiente de seguimiento </option>
                            <option value='ESTABLE'> Estable </option>
                    </select>
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
<script src="{{ asset('public/assets/js/select2.min.js')}}"></script>
<script src="{{ asset('public/assets/js/moment.min.js')}}"></script>
<script src="{{ asset('public/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap-datetimepicker.min.css')}}">
@endsection