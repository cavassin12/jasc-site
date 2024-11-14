@extends('admin/master')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Cadastro de Jogos</h2>
        <form action="{{url('/painel/galeria/novosalvar')}}" method="post">
            @method('PUT')
            @csrf
            
            <div class="mb-3">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control" id="data" name="data" required="">
            </div>
            
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required="" minlength="5">
            </div>
            
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</div>

@stop