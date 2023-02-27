@extends('template')

@section('content')

<div class="row">
    <div class="col-lg-7 offset-lg-3">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form method="post" enctype="multipart/form-data" action="{{ route('paciente.store') }}">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <p> Patologias </p>
                    @foreach ($patologias as $var)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="{{ $var->id }}" name="{{ $var->id }}">
                        <label class="form-check-label" for="{{ $var->id }}">{{ $var->nombre }}</label>
                    </div>
                    @endforeach
                </div>    
                <div class="col-sm-8">
                    <p> Pruebas/Examenes medicos </p>
                    <div class="row">
                    @foreach ($pruebas as $var2)
                        <div class="form-check col-sm-4">
                            <input type="checkbox" class="form-check-input" value="{{ $var2->id }}" name="{{ $var2->id }}">
                            <label class="form-check-label" for="{{ $var2->id }}">{{ $var2->nombre }}</label>
                        </div>
                        <div class="form-group col-sm-8">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="notas">Notas</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="notas">
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>    
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

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endsection