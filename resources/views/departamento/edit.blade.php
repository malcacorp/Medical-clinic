@extends('template')


@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Registrar un nuevo departamento</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form method="post" action="{{route('departamento.update', $item )}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nombre del departamento</label>
                <input required class="form-control" value="{{$item->nombre}}" name="nombre" type="text">
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea required cols="30" rows="4" value="{{$item->descripcion}}" name="descripcion" class="form-control">{{$item->descripcion}}</textarea>
                </div>
                <div class="form-group">
                    <label class="display-block">Estado del departamento</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="estado" @if($item->estado=="ACTIVO") checked @endif id="product_active" value="ACTIVO" >
                        <label class="form-check-label" for="product_active">
                        Activo
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" @if($item->estado=="INACTIVO") checked @endif type="radio" name="estado" id="product_inactive" value="INACTIVO">
                        <label class="form-check-label" for="product_inactive">
                        Inactivo
                        </label>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">Actualizar  Departmento</button>
                </div>
            </form>
        </div>
    </div>
@endsection