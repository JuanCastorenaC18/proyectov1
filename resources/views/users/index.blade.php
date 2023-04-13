@extends('users.layout')
 
@section('contenttre')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-dark">DLCC production</h2>
            </div>
            <br>
            @can('users.create')
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Crear nuevo usuario</a>
                </div>
            @endcan
            
            <br>
        </div>
    </div>
   
    @if ($message = Session::get('Exito'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Estatus</th>
            <th width="280px">Accion</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->status }}</td>
            <td>
                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                    @can('users.show')
                        @if ($user->status == true)
                            <a class="btn btn-primary" href="{{ route('users.show',$user->id) }}">Ver</a>
                        @else
                            <!--Ningun boton ya que esta desactivo-->
                        @endif
                    @endcan
                    
                    @can('users.editpermiso')
                        @if ($user->status == true)
                            <a class="btn btn-warning" href="{{ route('users.editpermiso',$user->id) }}">Editar Permisos</a>
                        @else
                            <!--Ningun boton ya que esta desactivo-->
                        @endif
                    @endcan

                    
                    
                    @can('users.destroy')
                        @csrf
                        @method('DELETE')
                        @if ($user->status == true)
                            <button type="submit" class="btn btn-outline-danger">Desactivar</button>
                        @else
                            <button type="submit" class="btn btn-outline-info">Activar</button>
                        @endif
                    @endcan

                    
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $users->links() !!}

    @can('users.destroy')
        <p style="color: #000000">Usted ya tiene permisos.</p>
    @endcan
    @cannot('users.destroy')
        <p style="color: #000000">Usted no tiene permisos vaya al menu de supervisor para solicitarlo.</p>
    @endcannot
      
@endsection