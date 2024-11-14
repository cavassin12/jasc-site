@extends('admin/master')
@section('content')
<br>
<div class="row">
    <div class="col-md-10">
       <h2>Galerias</h2>
    </div>
    <div class="col-md-2">
        <a href="{{url('/painel/galeria/nova')}}" class="btn btn-info">Nova</a>
    </div>
</div>
<hr>
<div class="row">
    
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
                        <td>{{$i->descricao}}</td>
                        <td>{{$i->status=='1'?'Ativo':'Inativo'}}</td>
                        <td>{{App\Models\Sistema::toDataBR($i->data)}}</td>
                        <td>
<!--                            <a href="{{url('/painel/galeria/editar/'.base64_encode($i->codigo)."")}}"><i class="fa fa-pencil"></i> Editar</a>
                            &nbsp;
                            &nbsp;-->
                            <a href="{{url('/painel/galeria/imagens/'.base64_encode($i->codigo)."")}}"><i class="fa fa-pencil"></i> Imagens</a>
                            &nbsp;
                            &nbsp;
                            @if($i->status=='1')
                            <a href="{{url('/painel/galeria/desativar/'.base64_encode($i->codigo)."")}}"><i class="fa fa-times"></i>Desativar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
