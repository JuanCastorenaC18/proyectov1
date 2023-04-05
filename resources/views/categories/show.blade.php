@extends('categories.layout')
  
@section('contenttwo')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-dark"> Mostrar categoria</h2>
            </div>
            <br>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Atras</a>
            </div>
            <br>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">Nombre:</strong>
                {{ $category->nombre }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">Descripcion:</strong>
                {{ $category->descripcion }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">Estatus:</strong>
                {{ $category->status }}
            </div>
        </div>
    </div>
@endsection