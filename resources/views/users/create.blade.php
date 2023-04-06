@extends('users.layout')
  
@section('contenttre')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1 class="text-dark">Añadir Usuario</h1>
        </div>
        <br>
        @can('users.index')
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Atras</a>
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
   
<form action="{{ route('users.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong>Nombre:</strong>
                <input type="text" name="name" class="form-control" placeholder="Nombre">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong>Correo:</strong>
                <input type="email" name="email" class="form-control" placeholder="Correo">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong>Contraseña:</strong>
                <input type="password" name="password" class="form-control" placeholder="Contraseña">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <br>
            <button type="submit" class="btn btn-outline-success">Enviar</button>
        </div>
    </div>
   
</form>
@endsection