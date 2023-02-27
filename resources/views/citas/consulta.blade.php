@extends('template')

@section('content')
    @php
    $paciente = "culo";
    @endphp
    <div class="row">
        <div class="col-lg-7 offset-lg-3">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="post" enctype="multipart/form-data" action="{{ route('consultas',$cita) }}">
                @csrf
                <p class="page-title fa fa-heartbeat"> Registro de Consulta Paciente</p>
                <div class="profile-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">General</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Antecedentes</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Habitos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab4" data-toggle="tab">Examen Físico</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="about-cont">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="motivo">Motivo de la Consulta<span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="3" name="motivo"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="EA">Enfermedad Actual</label>
                                    <textarea class="form-control" rows="4" name="EA"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="bottom-tab2">
                            <div class="col-sm-12">
                                <p>Antecedentes familiares</p>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Madre</label>
                                            <textarea class="form-control" rows="3" name="madre">@isset($antecedente->madre) {{ $antecedente->madre }} @endisset</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Padre</label>
                                            <textarea class="form-control" rows="3" name="padre">@isset($antecedente->padre) {{ $antecedente->padre }} @endisset</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hermanos</label>
                                            <textarea class="form-control" rows="3" name="hermanos">@isset($antecedente->hermanos) {{ $antecedente->hermanos }} @endisset</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hijos</label>
                                            <textarea class="form-control" rows="3" name="hijos">@isset($antecedente->hijos) {{ $antecedente->hijos }} @endisset</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="bottom-tab3">
                            <div class="col-sm-12">
                                <p>Hábitos</p>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="display-block">Tabaquismo</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tbq_bool"
                                                    id="product_active" value="1" checked>
                                                <label class="form-check-label" for="product_active">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tbq_bool"
                                                    id="product_inactive" value="0">
                                                <label class="form-check-label" for="product_inactive">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label>Detalles</label>
                                            <div>
                                                <input type="text" class="form-control" name="tbq_det" @isset($habito->tbq_det) value="{{ $habito->tbq_det }}" @endisset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="display-block">Alcoholismo</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="alc_bool"
                                                    id="product_active" value="1" checked>
                                                <label class="form-check-label" for="product_active">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="alc_bool"
                                                    id="product_inactive" value="0">
                                                <label class="form-check-label" for="product_inactive">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label>Detalles</label>
                                            <div>
                                                <input type="text" class="form-control" name="alc_det" @isset($habito->alc_det) value="{{ $habito->alc_det }}" @endisset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="display-block">Drogas Ilícitas</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="drg_bool"
                                                    id="product_active" value="1" checked>
                                                <label class="form-check-label" for="product_active">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="drg_bool"
                                                    id="product_inactive" value="0">
                                                <label class="form-check-label" for="product_inactive">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label>Detalles</label>
                                            <div>
                                                <input type="text" class="form-control" name="drg_det" @isset($habito->drg_det) value="{{ $habito->drg_det }}" @endisset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Sexuales</label>
                                    <div>
                                        <input type="text" class="form-control" name="sex" @isset($habito->sex) value="{{ $habito->sex }}" @endisset>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nutricionales</label>
                                    <div>
                                        <input type="text" class="form-control" name="nut" @isset($habito->nut) value="{{ $habito->nut }}" @endisset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="bottom-tab4">
                            <div class="col-sm-12">
                                <p>Examen Físico</p>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="comentario">Condiciones Generales</label>
                                    <textarea class="form-control" rows="3" name="condiciones"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Peso</label>
                                            <div>
                                                <input type="text" class="form-control" name="peso">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Talla</label>
                                            <div>
                                                <input type="text" class="form-control" name="talla">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Índice de Masa Corporal</label>
                                            <div>
                                                <input type="text" class="form-control" name="imc">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Tensión Arterial</label>
                                            <div>
                                                <input type="text" class="form-control" name="TA">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Frecuencia Cardíaca</label>
                                            <div>
                                                <input type="text" class="form-control" name="FC">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Frecuencia Respiratoria</label>
                                            <div>
                                                <input type="text" class="form-control" name="FR">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="comentario">Observaciones</label>
                                    <textarea class="form-control" rows="4" name="observaciones"></textarea>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Regisrar cita</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
@endsection

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
@endsection
