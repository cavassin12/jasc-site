@extends('admin/master')
@section('content')
<div class="row">
    <h2>Notícias</h2>
    <div class="col-md-12">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($itens as $i)
                    <tr>
                        <td>{{$i->titulo}}</td>
                        <td>{{$i->status=='1'?'Ativo':'Inativo'}}</td>
                        <td>{{App\Models\Sistema::toDataHoraBR($i->dt_record)}}</td>
                        <td>
                            <a href="{{url('/painel/noticias/editar/'.base64_encode($i->codigo)."")}}"><i class="fa fa-pencil"></i> Editar</a>
                            &nbsp;
                            &nbsp;
                            <a href="{{url('/painel/noticias/imagens/'.base64_encode($i->codigo)."")}}"><i class="fa fa-pencil"></i> Imagens</a>
                            &nbsp;
                            &nbsp;
                            @if($i->status=='1')
                            <a href="{{url('/painel/noticias/desativar/'.base64_encode($i->codigo)."")}}"><i class="fa fa-times"></i>Desativar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
