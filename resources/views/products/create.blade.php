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

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
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
                <textarea class="form-control" style="height:100px" name="descripcion" placeholder="Descripcion"></textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <img id="imagenSelecionada" src="#" alt="Vista previa de la imagen" style="display: none; max-height: 70px; max-width: 70px;">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong>Imagen:</strong>
                <input type="file" id="imagen" name="imagen" class="form-control" placeholder="Imagen">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong>Categoria:</strong>



                <select name="categoria" class="form-control" placeholder="Categoria" aria-label="Default select example">
                    <option selected>Seleccione la categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <br>
            <button type="submit" class="btn btn-outline-success">Enviar</button>
        </div>
    </div>

</form>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(e){
        $('#imagen').change(function(){
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#imagenSelecionada').attr('src', e.target.result);
                $('#imagenSelecionada').show();
            }
            reader.readAsDataURL(this.files[0]);
        })
    })
</script>
@endsection


