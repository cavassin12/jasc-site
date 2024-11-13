@extends('admin/master')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Cadastro de Jogos</h2>
        <form action="{{url('/painel/jogos/novosalvar')}}" method="post">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="cidade" class="form-label">Cidade </label>
                <select class="form-select" id="cidade" name="cidadea" required="">
                    <option selected>Selecione uma cidade</option>
                    @foreach($cidades as $c)
                        <option value="{{base64_encode($c->codigo)}}">{{$c->descricao}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="cidade" class="form-label">Contra Cidade</label>
                <select class="form-select" id="cidade" name="cidadeb" required="">
                    <option selected>Selecione a segunda cidade</option>
                    @foreach($cidades as $b)
                        <option value="{{base64_encode($b->codigo)}}">{{$b->descricao}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control" id="data" name="data" required="">
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" class="form-control" id="hora" name="hora" required="">
            </div>
            <div class="mb-3">
                <label for="local" class="form-label">Local</label>
                <input type="text" class="form-control" id="local" name="local" required="">
            </div>
            <div class="mb-3">
                <label for="link" " class="form-label">Link</label>
                <input type="text" class="form-control" id="link" name="link">
            </div>
            <div class="mb-3">
                <label for="modalidade" class="form-label">Modalidade</label>
                <select class="form-select" id="modalidade" name="modalidade" required="">
                    <option selected>Selecione uma modalidade</option>
                   @foreach($modalidades as $m)
                        <option value="{{base64_encode($m->codigo)}}">{{$m->descricao}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</div>

@stop