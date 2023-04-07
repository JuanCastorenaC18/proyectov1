@extends('products.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-dark">DLCC production</h2>
            </div>
            <br>
            @can('products.create')
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('products.create') }}"> Crear nuevo producto</a>
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
            <th>Precio</th>
            <th>Stock</th>
            <th>Descripcion</th>
            <th width="10%">Imagen</th>
            <th>Categoria</th>
            <th>Estatus</th>

            <th width="280px">Accion</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->nombre }}</td>
            <td>{{ $product->precio }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->descripcion }}</td>
            <td><img src="/imagen/{{ $product->imagen }}" height="30%" width="30%"></td>
            <td>{{ $product->categoria }}</td>
            <td>{{ $product->status }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    @can('products.show')
                        @if ($product->status == true)
                            <a class="btn btn-outline-primary" href="{{ route('products.show',$product->id) }}">Ver</a>
                        @else
                            <!--Ningun boton ya que esta desactivo-->
                        @endif
                    @endcan
                    
                    @can('products.edit')
                        @if ($product->status == true)
                            <a class="btn btn-outline-warning" href="{{ route('products.edit',$product->id) }}">Editar</a>
                        @else
                            <!--Ningun boton ya que esta desactivo-->
                        @endif
                    @endcan
                    
                    @can('products.destroy')
                        @csrf
                        @method('DELETE')
                        @if ($product->status == true)
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
    <hr style="border-color: #000000; border-width: 2px;">
    <br>
    @can('enviarPeticion')
        <form class="form-group text-center border p-4" action="/enviarPeticion" method="GET">
            <h1 class="text-dark">Solicite permisos para poder modificar</h1>
            <br>
            <button type="submit" class="btn btn-outline-success">Enviar Correo</button>
        </form>
    @endcan
  
    {!! $products->links() !!}
      
@endsection