@extends('template')

@section('content')

<div class="row">
    <div class="col-lg-7 offset-lg-3">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form method="post" enctype="multipart/form-data" action="{{ route('paciente.prueba.store') }}">
            @csrf
            <input type="hidden" value="{{ $paciente }}" name="id_persona">
            <div class="col-sm-9">
                <p>Registro de Examenes Medicos a Paciente</p>
                <div class="form-group">
                    <label for="id_alergia">Prueba</label>
                    <select class="form-control select" name="id_prueba">
                        @foreach($pruebas as $prueba)
                            <option value='{{ $prueba->id }}'>{{ $prueba->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Fecha</label>
                    <div class="cal-icon">
                        <input type="text" class="form-control datetimepicker" name="fecha">
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label for="comentario">Comentarios<span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="3" name="comentario"></textarea>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Examen</label>
                    <div class="profile-upload">
                     
                        <div class="upload-input">
                            <input type="file" id="ruta_foto" required  name="ruta_archivo" class="form-control" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn">Guardar Prueba</button>
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