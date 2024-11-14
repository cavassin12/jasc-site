@extends('admin/master')
@section('content')
<br>
<div class="row">
    <div class="col-md-10">
       <h2>Jogos</h2>
    </div>
    <div class="col-md-2">
        <a href="{{url('/painel/jogos/novo')}}" class="btn btn-info">Novo</a>
    </div>
</div>
<hr>
<div class="row">
    
    <div class="col-md-12">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Modalidade</th>
                    <th>Ciade </th>
                    <th>contra Ciade </th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($itens as $i)
                    <tr>
                        <td>{{$i->nm_modalidade}}</td>
                        <td>{{$i->cidade_a}}</td>
                        <td>{{$i->cidade_b}}</td>
                        <td>{{App\Models\Sistema::toDataHoraBR($i->data." ".$i->hora)}}</td>
                        <td>
                            <a href="{{url('/painel/jogos/editar/'.base64_encode($i->codigo)."")}}"><i class="fa fa-pencil"></i> Editar</a>
                            &nbsp;
                            &nbsp;
                            <a href="{{url('/painel/jogos/destaque/'.base64_encode($i->codigo)."")}}"><i class="fa fa-pencil"></i> Destacar</a>
                            &nbsp;
                            &nbsp;
                            @if($i->status=='1')
                            <a href="{{url('/painel/jogos/desativar/'.base64_encode($i->codigo)."")}}"><i class="fa fa-times"></i>Desativar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
