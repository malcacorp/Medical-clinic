@extends('template')

@section('content')

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Registrar Inmunización </h4>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form method="POST" @if(isset($inmunizacion)) action="{{ route('inmunizacion.update', $inmunizacion->id) }}" @else action="{{ route('inmunizacion.save') }}" @endif>
            @csrf
            @if(isset($inmunizacion))
                @method('PUT')
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" type="text" name="nombre" 
                        @isset($inmunizacion) 
                            value="{{$inmunizacion->nombre}}"
                        @endisset
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn">Guardar Inmunización</button>
                </div>
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