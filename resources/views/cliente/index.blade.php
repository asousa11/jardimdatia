@extends('layouts.layout')

@section('conteudo')

    @if(count($clientes) == 0)

        <div class="container" style="padding-bottom: 16.4%">
            <div class="justify-content-center">
                <div class="col-md-12">

                    <div class="card mt-5">
                        <div class="card-header p-5" style="background: url('/images/clientes.jpg'); background-position: center; background-size: cover;">
                            <h1 class="text-black" style="font-weight: 200">Gestão de Clientes</h1>

                        </div>

                        <div class="card-body">

                            <div class="alert alert-danger" role="alert">
                                Não existem Clientes !

                                <a href="/clientes/create" style="padding-left: 20px">
                                    <button type="button" class="btn btn-primary">Adicionar Cliente</button>
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
                    <div class="card-header p-5" style="background: url('/images/clientes.jpg'); background-position: center; background-size: cover;">
                        <h1 class="text-black" style="font-weight: 200">Gestão de Clientes</h1>
                        <div class="row">
                            <div class="col-md-6">
                            <a href="/clientes/create">
                                <button type="button" class="btn btn-primary">Adicionar Cliente</button>
                            </a>
                        </div>
                            <div class="col-md-6 float-right">
                                <form action="/searchCliente" method="get">
                                    <div class="input-group">
                                        <input type="search" name="search" class="form-control" placeholder="Nome Cliente">
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
                                    <th scope="col">Contribuinte</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Morada</th>
                                    <th scope="col">Cartão</th>
                                    <th scope="col">Opcões</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clientes as $cliente)
                                    <tr>
                                        <th><a href="/clientes/{{$cliente->numContribuinte}}">{{$cliente->numContribuinte}}</a></th>
                                        <td>{{$cliente->nome}}</td>
                                        <td>{{$cliente->email}}</td>
                                        <td>{{$cliente->morada}}</td>
                                        @if($cliente->cartao)
                                            <td><label> Com Cartão</label></td>
                                        @else
                                            <td><label>Sem Cartão</label></td>
                                        @endif

                                        <td>
                                            {{--Edit Button--}}
                                            <a href="{{route('clientes.edit',$cliente->numContribuinte)}}" class="float-left" >
                                                <button type="button" class="btn btn-primary float-left">Editar</button>
                                            </a>


                                            <form action="{{ route('clientes.destroy',$cliente->numContribuinte)}}" method="POST" class="float-left">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger ml-1">Eliminar</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>


                        {{$clientes->links()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
