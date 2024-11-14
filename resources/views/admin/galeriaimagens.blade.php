@extends('admin/master')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Adicionar imagens</h2>
        <form action="{{url('/painel/galeria/imagens/add')}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <input type="hidden" name="galeria_codigo" value="{{$chave}}">
                <div class="col-md-12">
                    <label for="files" class="form-label">Imagens</label>
                    <input type="file" class="form-control" id="files" name="file" accept="image/*">
                </div>
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>

@stop