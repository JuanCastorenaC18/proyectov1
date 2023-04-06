@extends('products.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1 class="text-dark">Añadir nuevo producto</h1>
        </div>
        <br>
        @can('products.index')
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Atras</a>
            </div>
        @endcan
        <br>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>¡Vaya!</strong> Hubo algunos problemas con su entrada.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('products.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong>Nombre:</strong>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong>Precio:</strong>
                <input type="text" name="precio" class="form-control" placeholder="Precio">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong>Stock:</strong>
                <input type="text" name="stock" class="form-control" placeholder="Stock">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong>Descripcion:</strong>
                <textarea class="form-control" style="height:150px" name="descripcion" placeholder="Descripcion"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong>Categoria:</strong>
                <select name="categoria" class="form-control" placeholder="Categoria" aria-label="Default select example">
                    <option selected>Seleccione la categoria</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <br>
            <button type="submit" class="btn btn-outline-success">Enviar</button>
        </div>
    </div>
   
</form>
@endsection