@extends('template')

@section('content')

    <div class="row">
        <div class="col-lg-8 offset-lg-4">
            <h4 class="page-title fa fa-cog"> Ajustes </h4>
        </div>
    </div>
    <div class="profile-tabs">
        <ul class="nav nav-tabs nav-tabs-bottom">
            <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Patologias</a></li>
            <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Medicamentos</a></li>
            <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Alergias</a></li>
            <li class="nav-item"><a class="nav-link" href="#bottom-tab4" data-toggle="tab">Examenes Medicos</a></li>
            <li class="nav-item"><a class="nav-link" href="#bottom-tab5" data-toggle="tab">Inmunizaciones</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="about-cont">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Añadir Patologias</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('patologia.add') }}" class="btn btn btn-primary btn-rounded float-right"><i
                                class="fa fa-plus"></i> Registrar Patologia</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive ">
                            <table class="table table-border table-striped custom-table datatable mb-0" id="example">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patologias as $patologia)
                                        <tr>
                                            <td>{{ $patologia->nombre }}</td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="{{ route('patologia.editar', $patologia->id) }}"><i
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

            <!--  -------------------------------------------------------------------- -->

            <div class="tab-pane" id="bottom-tab2">
                <div class="row m-t-2">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Añadir Medicamentos</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('medicamento.add') }}" class="btn btn btn-primary btn-rounded float-right"><i
                                class="fa fa-plus"></i> Registrar Medicamento</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive ">
                            <table class="table table-border table-striped custom-table datatable mb-0" id="example">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicamentos as $medicamento)
                                        <tr>
                                            <td>{{ $medicamento->nombre }}</td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
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

            <!--  -------------------------------------------------------------------- -->

            <div class="tab-pane" id="bottom-tab3">
                <div class="row m-t-2">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Añadir Alergias</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('alergia.add') }}" class="btn btn btn-primary btn-rounded float-right"><i
                                class="fa fa-plus"></i> Registrar Alergia</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive ">
                            <table class="table table-border table-striped custom-table datatable mb-0" id="example">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alergias as $alergia)
                                        <tr>
                                            <td>{{ $alergia->nombre }}</td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
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

            <!--  -------------------------------------------------------------------- -->

            <div class="tab-pane" id="bottom-tab4">
                <div class="row m-t-2">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Añadir Examenes Medicos</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('prueba.add') }}" class="btn btn btn-primary btn-rounded float-right"><i
                                class="fa fa-plus"></i> Registrar Prueba</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive ">
                            <table class="table table-border table-striped custom-table datatable mb-0" id="example">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pruebas as $prueba)
                                        <tr>
                                            <td>{{ $prueba->nombre }}</td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="{{ route('prueba.editar', $prueba) }}"><i
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

            <!--  -------------------------------------------------------------------- -->

            <!--  -------------------------------------------------------------------- -->

            <div class="tab-pane" id="bottom-tab5">
                <div class="row m-t-2">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Inmunizaciones</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('inmunizacion.add') }}" class="btn btn btn-primary btn-rounded float-right"><i
                                class="fa fa-plus"></i> Registrar Inmunización</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive ">
                            <table class="table table-border table-striped custom-table datatable mb-0" id="example">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inmunizaciones as $inmunizacion)
                                        <tr>
                                            <td>{{ $inmunizacion->nombre }}</td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="{{ route('inmunizacion.editar', $inmunizacion) }}"><i
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
    <!--  -------------------------------------------------------------------- -->
@endsection
@section('modals')
    <div id="delete_patient" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                    <h3>¿Seguro que desea Eliminar el paciente?</h3>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Cerrar</a>
                        <form method="post" action="{{ route('paciente.delete') }}">
                            @csrf
                            @method('delete')
                            <input hidden name="id" id="id_item" type="text" />
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('public/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
@endsection

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap-datetimepicker.min.css') }}">
@endsection
