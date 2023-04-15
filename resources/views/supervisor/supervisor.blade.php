@extends('supervisor.layout')

@section('contentsuper')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-dark">Mandar Token de Permiso a un usuario</h2>
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
    @can('enviarPeticionAdmin')
        <form class="form-group text-center border p-4" action="{{ route('enviarPeticionAdmin') }}" method="GET">
            <h1 class="text-dark">Solicite permisos para poder desactivar</h1>
            <br>
            <button type="submit" class="btn btn-outline-success">Enviar Correo</button>
        </form>
    @endcan
    <form action="{{ route('validacionTokenAdmin') }}" method="POST">
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

    <br>
    <br>
    <hr style="border-color: #000000; border-width: 2px;">
    <br>
    <h2 class="text-dark">SOLICITAR PERMISO AL ADMINISTRADOR</h2>

    {!! Form::open(['url' => '/sendToken', 'style' => 'border: 1px solid black; text-align: center;']) !!}
        <div class="form-group">
            <br>
            {!! Form::label('email', 'Correo electrónico al que se le va a enviar ', ['style' => 'color: black']) !!}
            <br>
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su correo electrónico', 'required' => true]) !!}
        </div>
        <br>
    {!! Form::submit('Enviar correo', ['class' => 'btn btn-outline-primary']) !!}
        <br>
    {!! Form::close() !!}

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Estatus</th>
        </tr>
        @foreach ($userscli as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->status }}</td>
        </tr>
        @endforeach
    </table>


    {!! $users->links() !!}
@endsection
