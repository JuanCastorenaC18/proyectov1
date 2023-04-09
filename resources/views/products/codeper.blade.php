@extends('products.layout')
 
@section('content')
    @if ($message = Session::get('Exito'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
    @endif
    <h1>Aqui agregas el permisos para modificar</h1>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
