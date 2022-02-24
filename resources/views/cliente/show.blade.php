@extends('layouts.layout')

@section('conteudo')
    <div class="container" style="padding-bottom: 15.5%">
        <div class="justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header p-5">
                        <h2 style="font-weight: 700">{{$cliente->nome}}</h2>
                    </div>
                    <div class="card-body p-5">

                            <div class="form-group row">
                                <label>Contribuinte:</label>
                                <label style="margin-left: 2%;">{{$cliente->numContribuinte}}</label>
                            </div>
                            <hr>

                                <div class="form-group row">
                                    <label>Nome:</label>
                                    <label style="margin-left: 2%;">{{$cliente->nome}}</label>
                                </div>
                            <hr>

                                <div class="form-group row">
                                    <label>Email:</label>
                                    <label style="margin-left: 2%;">{{$cliente->email}}</label>
                                </div>
                            <hr>
                                <div class="form-group row">
                                    <label>Morada:</label>
                                    <label style="margin-left: 2%;">{{$cliente->morada}}</label>
                                </div>
                            <hr>
                            @if($cliente->cartao)

                                <div class="form-group row">
                                    <label for="discount">Cartão Nº:</label>
                                    <label style="margin-left: 2%;">{{$cliente->cartao->numCartao}}</label>
                                </div>
                            <hr>
                                <div class="form-group row">
                                    <label for="discount">Pontos:</label>
                                    <label style="margin-left: 2%;">{{$cliente->cartao->pontosDisponiveis}}</label>
                                </div>
                            @else

                                <div class="form-group row">
                                    <label for="discount">Cartão Nº:</label>
                                    <label style="margin-left: 2%;">Sem Cartão</label>
                                </div>

                            @endif
                        <br>
                        <hr>

                        {{--Tabela Ultimas 10 Compras do Cliente--}}
                        <div class="card-header p-5">
                            <h2 style="font-weight: 700">Últimas 10 compras</h2>
                        </div>
                        <div class="table-responsive-md">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Venda Nº</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Data de Abertura</th>
                                    <th scope="col">Data de Fecho da Venda</th>
                                    <th scope="col">Total Sem Desconto</th>
                                    <th scope="col">Valor do Desconto</th>
                                    <th scope="col">Total Final</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($vendas as $venda)
                                    <tr>
                                        {{--                Codigo da Venda--}}
                                        <th>{{$venda->id}}</th>
                                        {{--                Estado da Venda--}}
                                        @if($venda->aberta == 1)
                                            <td>Aberta</td>
                                            {{--                Data de Abertura--}}
                                            <td>{{$venda->created_at}} </td>
                                            {{--                Data de Fecho--}}
                                            <td class="text-center">-</td>
                                        @else
                                            <td>Fechada</td>
                                            {{--                Data de Abertura--}}
                                            <td>{{$venda->created_at}} </td>
                                            {{--                Data de Fecho--}}
                                            <td>{{$venda->updated_at}} </td>
                                        @endif

                                        {{--                Total Sem Desconto--}}
                                        <td>{{round($venda->total, 2)}} &euro;</td>
                                        {{--                Valor Do Desconto--}}
                                        <td>{{round($venda->descontoTotal, 2)}} &euro;</td>
                                        {{--                Total Final--}}
                                        <td>{{round($venda->total, 2) - round($venda->descontoTotal, 2)}} &euro;</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>

                        <div class="form-group row">

                            <a href="{{url()->previous()}}" role="button">
                                <button class="btn btn-danger ml-1">Voltar</button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
