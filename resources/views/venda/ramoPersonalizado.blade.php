@extends('layouts.layout')

@section('conteudo')

    <div class="container">
        <div class="card mt-5">
            <div class="card-header p-5">
                <div class="row">
                    <div class="col-md-8">
                        <h1 style="font-weight: 200;">Personalizar Ramo</h1>
                    </div>
                    <div class="col-md-4">
                        <form action="{{route('searchProdutoRamoPersonalizado',[$venda,$ramo])}}" method="get">
                            <div class="input-group pt-2">
                                <input type="search" name="search" class="form-control" placeholder="Nome Produto">
                                <span class="input-group-prepend">
                                <button type="submit" class="btn btn-primary rounded-right">Search</button>
                            </span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="d-flex flex-row-reverse">
                    <form action="{{ route('eliminarRamoPersonalizado',[$venda,$ramo])}}" method="POST" class="float-left">
                        @csrf
                        @method('delete')
                        <div>
                            <button type="submit" class="btn btn-danger">Voltar</button>
                        </div>
                    </form>
                </div>





            </div>

            <div class="card-body">
                <div class="form-group p-5">
                    <h1 style="font-weight: 700">Ramo Personalizado N. {{$ramo->codProduto}}</h1>
                </div>
                <div class="row">
                    <div class="col-md-2 form-group ">
                        <h6>Venda N. </h6>
                        <h1 style="font-weight: 700">{{$venda->id}}</h1>
                    </div>
                    <div class="col-md-4 form-group ">
                        <label for="discount">Data:</label>
                        <h1 style="font-weight: 700">{{$ramo->created_at->format('d-m-Y')}}</h1>
                    </div>

                    <div class="col-md-3 form-group ">
                        <label for="phone">Estado:</label>
                        @if($venda->aberta)
                            <h1 style="font-weight: 700">Em Aberto</h1>
                        @else
                            <h1 style="font-weight: 700">Fechado</h1>
                        @endif

                    </div>

                    <div class="col-md-3 form-group ">
                        <label for="discount">Cliente:</label>
                        <h1 style="font-weight: 700">{{$venda->cliente->numContribuinte}}</h1>
                    </div>
                </div>

            </div>
        </div>

        {{--    Tabela--}}
    <div class="table-responsive-md">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Cod. Produto</th>
                <th scope="col">Designação</th>
                <th scope="col">Preço</th>
                <th scope="col">Qt. em stock</th>
                <th scope="col">Desconto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Acção</th>
                <th scope="col">Alertas</th>
            </tr>
            </thead>
            <tbody>

            @foreach($produtos as $produto)
                <tr>
                    {{--                Codigo Produto--}}
                    <th>{{$produto->codProduto}}</th>
                    {{--                Descricao--}}
                    <td>{{$produto->descricao}}</td>
                    {{--                Preço--}}
                    <td>{{number_format($produto->preco,2)}} &euro;</td>
                    {{--                Stock--}}
                    @if($produto->quantidade_stock > 0)
                        <td>{{$produto->quantidade_stock}} Und.</td>
                    @else
                        <td><span class="badge badge-danger">Sem Stock</span></td>
                    @endif
                    {{--                Percentagem Desconto--}}
                    @if($produto->promocao && $produto->promocao->datainicio <= now() && $produto->promocao->datafim >= now())
                        <td>{{$produto->promocao->percentagem}} %</td>
                    @else
                        <td><span class="badge badge-danger">Sem Desconto</span></td>
                    @endif

                    <form action="{{route('adicionarArtigoRamo',[$ramo,$produto->codProduto])}}" method="POST" class="float-left">
                        {{--                    /ramopersonalizado/{{$ramo->codProduto}}/{{$produto->codProduto}}--}}
                        @csrf

                        {{--                    Quantidade--}}
                        <td>
                            <div>
                                @if($produto->quantidade_stock == 0 )
                                    <input type="text" class="form-control @error('qt') is-invalid @enderror" id="qt" name="qt" value="{{ old('qt') }}" placeholder="Qt" disabled required>
                                @else
                                    <input type="text" class="form-control @error('qt') is-invalid @enderror" id="qt" name="qt" value="{{ old('qt') }}" placeholder="Qt" required>
                                @endif

                                @error('qt')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </td>

                        {{--                                            Adicionar Button--}}
                        <td>
                            @if($produto->quantidade_stock == 0 )
                                <button type="submit" class="btn btn-warning" disabled>Adicionar</button>
                            @else
                                <button type="submit" class="btn btn-warning">Adicionar</button>
                            @endif
                        </td>

                        {{--                    Alertas--}}

                        <td>
                            @if($produto->quantidade_stock == 0)
                                <span class="badge badge-danger">Sem stock</span>
                                @if($produto->epoca && (now() < $produto->epoca->datainicio || now() > $produto->epoca->datafim))
                                    <span class="badge badge-danger">Fora de Época</span>
                                @endif
                            @elseif($produto->quantidade_stock < 10)
                                <span class="badge badge-warning">Últimas Unidades</span>
                                @if($produto->epoca && (now() < $produto->epoca->datainicio || now() > $produto->epoca->datafim))
                                    <span class="badge badge-danger">Fora de Época</span>
                                @endif
                            @else
                                <span class="badge badge-success">Disponível</span>
                                @if($produto->epoca && (now() < $produto->epoca->datainicio || now() > $produto->epoca->datafim))
                                    <span class="badge badge-danger">Fora de Época</span>
                                @endif
                            @endif
                        </td>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


        {{$produtos->links()}}

        @if(count($ramo->artigoRamo) > 0)
            <hr>
        <div class="table-responsive-md">
            <table class="table">
                <div class="col-md-12 text-center" style="padding: 10px;background-color: #6bbf3d;">
                    <h4 style="font-weight: 200; color:white;">Produtos Inseridos</h4>
                </div>
                <div class="col-md-12  text-right" style="padding: 10px">
                    <h5> Total: {{number_format($ramo->preco,2) }} &euro;</h5>
                    <h5> Total Final: {{number_format(($ramo->preco) - ($ramo->preco * $ramo->promocao->percentagem /100),2)}} &euro;</h5>
                    @if($venda->cliente->cartao)
                        <h5> Saldo em Cartão: {{number_format($venda->cliente->cartao->saldoacumulado,2)}} &euro;</h5>
                    @endif

                    @if(count($ramo->artigoRamo) >= 1)
                        <a href="{{route('resumoRamoPersonalizado',[$venda,$ramo])}}">
                            <button type="button" class="btn btn-primary">Finalizar Personalização</button>
                        </a>
                    @endif

                    <form action="{{ route('eliminarRamoPersonalizado',[$venda,$ramo])}}" method="POST" class="float-left">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger ml-1">Sair</button>
                    </form>
                </div>



                <thead>
                <tr>
                    <th scope="col">Cod. Produto</th>
                    <th scope="col">Designação</th>
                    <th scope="col">Preço Unitário</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Total Produto</th>
                    <th scope="col">Total Desconto</th>
                    <th scope="col">Total Final</th>
                    <th scope="col">Acções</th>
                </tr>
                </thead>

                <tbody>

                @foreach($ramo->artigoRamo->sortBy('created_at') as $ar)
                    <tr>
                        <td><a href="/produtos/{{$ar->codProduto}}">{{$ar->codProduto}}</a></td>
                        <td>{{$ar->descricao}}</td>
                        <td>{{number_format($ar->preco_artigo_uni,2)}} &euro;</td>
                        <td>{{$ar->quantidade}} Und.</td>
                        <td>{{number_format($ar->preco_artigo_uni * $ar->quantidade,2)}} &euro;</td>
                        @if($ar->percentagemPromo != null)
                            <td>{{number_format($ar->preco_artigo_uni * $ar->quantidade * $ar->percentagemPromo / 100,2)}} &euro;</td>
                            <td>{{number_format(($ar->preco_artigo_uni * $ar->quantidade) - ($ar->preco_artigo_uni * $ar->quantidade * $ar->percentagemPromo / 100),2)}} &euro;</td>
                        @else
                            <td>0,00 &euro;</td>
                            <td>{{number_format($ar->preco * $ar->quantidade,2)}} &euro;</td>
                        @endif
                        <td>
                            <form action="{{ route('eliminarArtigoRamo',[$venda,$ramo,$ar])}}" method="POST" class="float-left">
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

        @endif

    </div>




@endsection
