@extends('layouts.layout')

@section('conteudo')

    @if(count($vendas) == 0)

        <div class="container" style="padding-bottom: 16.4%">
            <div class="justify-content-center">
                <div class="col-md-12">
                    <div class="card mt-5">
                        <div class="card-header p-5" style="background: url('/images/carousel1.jpg'); background-position: center; background-size: cover;">
                            <h1 class="text-white" style="font-weight: 200;">Gestão de Vendas</h1>

                        </div>

                        <div class="card-body">

                            <div class="alert alert-danger" role="alert">
                                Não existem Vendas !

                                <a href="/vendas/create" style="padding-left: 20px">
                                    <button type="button" class="btn btn-primary">Adicionar Venda</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @else

    <div class="container" style="padding-bottom: 16.4%">
        <div class="justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header p-5" style="background: url('/images/carousel1.jpg'); background-position: center; background-size: cover;">
                        <h1 class="text-white" style="font-weight: 200;">Gestão de Vendas</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="/vendas/create">
                                    <button type="button" class="btn btn-primary">Adicionar Venda</button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="/searchVenda" method="get">
                                    <div class="input-group">
                                        <input type="search" name="search" class="form-control" placeholder="Nif Cliente">
                                        <span class="input-group-prepend">
                                        <button type="submit" class="btn btn-primary  rounded-right">Pesquisar</button>
                                    </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md">


                        <table class="table">
                            <thead>
                            <tr>
                                <th class="align-content-center" scope="col">ID</th>
                                <th scope="col">Data</th>
                                <th scope="col">Nome Cliente</th>
                                <th scope="col">Contribuinte Cliente</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Opcões</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vendas as $venda)
                                <tr>
                                    <th><a href="/vendas/{{$venda->id}}">{{$venda->id}}</a></th>
                                    <td>{{$venda->cliente->created_at->format('d-m-Y')}}</td>
                                    <td>{{$venda->cliente->nome}}</td>
                                    <td>{{$venda->cliente->numContribuinte}}</td>
                                    @if($venda->aberta)
                                        <td>Aberta</td>
                                    @else
                                        <td>Fechada</td>
                                    @endif

                                    <td>
                                        {{-- Edit Button--}}


                                        <a href="/vendas/{{$venda->id}}/addProduto" class="float-left">
                                            @if($venda->aberta == true)
                                                <button type="button" class="btn btn-primary">Adicionar Produtos</button>
                                            @else
                                                <button type="button" class="btn btn-primary" disabled>Adicionar Produtos</button>
                                            @endif
                                        </a>

{{--                                        <a href="{{route('vendas.edit',$venda)}}" class="float-left">--}}
{{--                                            <button type="button" class="btn btn-primary float-left">Editar</button>--}}
{{--                                        </a>--}}


                                        <form action="{{ route('vendas.destroy',$venda)}}" method="POST" class="float-left">
                                            @csrf
                                            @method('delete')
                                            @if($venda->aberta == true)
                                                <button type="submit" class="btn btn-danger ml-1">Eliminar</button>
                                            @else
                                                <button type="submit" class="btn btn-danger ml-1" disabled>Eliminar</button>
                                            @endif
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>


                        {{$vendas->links()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
