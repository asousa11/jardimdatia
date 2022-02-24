@extends('layouts.layout')

@section('conteudo')
    <div class="container" style="padding-bottom: 15.5%">
        <div class="justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header p-5">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Resumo Venda - Sem Cartão</h1>
                            </div>
                            <div class="col-md-2">
                                Venda<h1 style="font-weight: 700">{{$venda->id}}</h1>
                            </div>
                            <div class="col-md-4">
                                Data <h1 style="font-weight: 700">{{$venda->created_at->format('d-m-Y')}}</h1>
                            </div>

                            <div class="col-md-4">
                                Estado
                                @if($venda->aberta)
                                    <h1 style="font-weight: 700">Aberta</h1>
                                @else
                                    <h1 style="font-weight: 700">Fechada</h1>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="card-body p-5">
                        <div class="form-group row">
                            <label for="nome">Cliente:</label>
                            <label style="margin-left: 2%;">{{$venda->cliente->nome}}</label>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label for="contribuinte">Contribuinte:</label>
                            <label style="margin-left: 2%;">{{$venda->cliente->numContribuinte}}</label>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label for="email">Email:</label>
                            <label style="margin-left: 2%;">{{$venda->cliente->email}}</label>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label for="morada">Morada:</label>
                            <label style="margin-left: 2%;">{{$venda->cliente->morada}}</label>
                        </div>
                    </div>

                        {{--                        Tabela --}}
                        <table class="table">
                            <div class="col-md-12 text-center" style="padding: 10px;background-color: #6bbf3d;">
                                <h4 style="font-weight: 200; color:white;">Produtos</h4>
                            </div>

                            <thead>
                            <tr>
                                <th scope="col">Cod. Produto</th>
                                <th scope="col">Designação</th>
                                <th scope="col">Preço Unitário</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Total Produto</th>
                                <th scope="col">Total Desconto</th>
                                <th scope="col" style="background: red">Total Final</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($venda->vendaProduto as $vp)
                                <tr>
                                    <td>{{$vp->codProduto}}</td>
                                    <td>{{$vp->descricao}}</td>
                                    <td>{{number_format($vp->preco,2)}} &euro;</td>
                                    <td>{{$vp->quantidade}} Und.</td>
                                    <td>{{number_format($vp->preco * $vp->quantidade,2)}} &euro;</td>
                                    @if($vp->percentagemPromo != null)
                                        <td>{{number_format($vp->preco * $vp->quantidade * $vp->percentagemPromo / 100,2)}} &euro;</td>
                                        <td style="background: #00AAAA; color: white">{{number_format(($vp->preco * $vp->quantidade) - ($vp->preco * $vp->quantidade * $vp->percentagemPromo / 100),2)}} &euro;</td>
                                    @else
                                        <td>0 &euro;</td>
                                        <td style="background: #00AAAA; color: white">{{$vp->preco * $vp->quantidade}} &euro;</td>
                                    @endif
                                </tr>
                            @endforeach


                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color: red"><strong>Total :</strong></td>
                                <td><strong>{{number_format($venda->total,2)}} &euro;</strong></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color: red"><strong>Total Desconto :</strong></td>
                                <td><strong>{{number_format($venda->descontoTotal,2)}} &euro;</strong></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color: red"><strong>Total Liquído :</strong></td>
                                <td><strong>{{number_format($venda->total - $venda->descontoTotal,2)}} &euro;</strong></td>
                            </tr>

                            </tbody>

                        </table>

                    <div class="card-body p-5">
                        <div class="form-group row">

                            <a href="/vendas/{{$venda->id}}/finalizarsemcartao" style="padding: 5px">
                                <button type="button" class="btn btn-primary">OK</button>
                            </a>

                            <a href="{{url()->previous()}}" role="button" style="padding: 5px">
                                <button class="btn btn-danger">Voltar</button>
                            </a>
                        </div>
                    </div>

                    </div>
                </div>
        </div>
    </div>>

@endsection
