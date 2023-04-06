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
   
    @if ($message = Session::get('success'))
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
            <td>{{ $product->categoria }}</td>
            <td>{{ $product->status }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    @can('products.show')
                        <a class="btn btn-outline-primary" href="{{ route('products.show',$product->id) }}">Ver</a>
                    @endcan
                    
                    @can('products.edit')
                        <a class="btn btn-outline-warning" href="{{ route('products.edit',$product->id) }}">Editar</a>
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
  
    {!! $products->links() !!}
      
@endsection