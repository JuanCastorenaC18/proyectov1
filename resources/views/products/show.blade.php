@extends('products.layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-dark"> Mostrar producto</h2>
            </div>
            <br>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Atras</a>
            </div>
            <br>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">Nombre:</strong>
                {{ $product->nombre }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">Precio:</strong>
                {{ $product->precio }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">Stock:</strong>
                {{ $product->stock }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">Descripcion:</strong>
                {{ $product->descripcion }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">Categoria:</strong>
                {{ $product->categoria }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">Estatus:</strong>
                {{ $product->status }}
            </div>
        </div>
    </div>
@endsection