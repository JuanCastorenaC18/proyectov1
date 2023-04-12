@extends('customers.layout')
 
@section('contentcustom')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-dark">SOLICITAR PERMISO AL SUPERVISOR</h2>
            </div>
            <br>
        </div>
    </div>
   
    @if ($message = Session::get('Exito'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('Error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    @can('enviarPeticion')
        <form class="form-group text-center border p-4" action="{{ route('enviarPeticion') }}" method="GET">
            <h1 class="text-dark">Solicite permisos para poder modificar</h1>
            <br>
            <button type="submit" id="btnpeticion" class="btn btn-outline-success">Enviar Correo</button>
        </form>
    @endcan
    <form action="{{ route('validacionToken') }}" method="POST">
        @csrf
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group text-dark">
                    <strong>Token:</strong>
                    <input type="text" name="token_one" class="form-control" placeholder="Ingrese el codigo del correo">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <br>
                <button type="submit" class="btn btn-outline-success">Enviar</button>
            </div>
        </div>
       
    </form>
      
@endsection