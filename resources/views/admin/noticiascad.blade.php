@extends('admin/master')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Cadastro de Notícias</h2>
        <form action="{{url('/painel/noticias/nova')}}" method="post">
            @method('PUT')
            @csrf
            <div class="row">
                <input type="hidden" name="codigo" value="{{base64_encode(0);}}">
                <div class="col-md-12">
                    <label for="titulo" class="form-label">Título da Notícia</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required="" minlength="5" maxlength="250">
                </div>
            </div>
            <div class="mb-3">
                <label for="conteudo" class="form-label">Conteúdo da Notícia</label>
                <textarea id="conteudo" name="conteudo" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
ClassicEditor
        .create(document.querySelector('#conteudo'))
        .catch(error => {
            console.error(error);
        });
</script>
@stop