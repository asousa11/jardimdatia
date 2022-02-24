@extends('layouts.layout')

@section('conteudo')

        @if(class_basename($produto) == 'Ramo')
            <div class="container" style="padding-bottom: 15.5%">
                <div class="justify-content-center">
                    <div class="col-md-12">
                        <div class="card mt-5">
                            <div class="card-header p-5">
                                <div class="col-md-12">
                                    <h1 style="font-weight: 200;">Ficha de Produto</h1>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Cod. Produto</th>
                                        <th scope="col">Designação</th>
                                        <th scope="col">Qt. em stock</th>
                                        <th scope="col">Preço Und.</th>
                                        <th scope="col">Desconto</th>
                                        <th scope="col">Preço Final</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>{{$produto->codProduto}}</th>
                                            <td>{{$produto->descricao}}</td>
                                            <td>{{$produto->quantidade_stock}}</td>
                                            @if($produto->promocao)
                                                <td>{{number_format($produto->preco,2)}} &euro;</td>
                                                <td>{{$produto->promocao->percentagem}} %</td>
                                                <td>{{$produto->preco -($produto->promocao->percentagem * $produto->preco)}} &euro;</td>
                                            @else
                                                <td>{{number_format($produto->preco,2)}} &euro;</td>
                                                <td>Sem Promo</td>
                                                <td>{{$produto->preco}} &euro;</td>
                                            @endif
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="card-body p-5">
                                <div class="col-md-12 text-center" style="padding: 10px;background-color: #6bbf3d;">
                                    <h4 style="font-weight: 200; color:white;">Produtos do Ramo</h4>
                                </div>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Código Produto</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Quantidade</th>
                                        <th scope="col">Preço Und.</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($produto->artigoRamo as $ar)
                                        <tr>
                                            <td>{{$ar->codProduto}}</td>
                                            <td>{{$ar->descricao}}</td>
                                            <td>{{$ar->quantidade}}</td>
                                            <td>{{$ar->preco_artigo_uni}} &euro;</td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                                <div class="form-group row">

                                    <a href="{{url()->previous()}}" role="button" style="padding: 5px">
                                        <button class="btn btn-danger">Voltar</button>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @else

            <div class="container" style="padding-bottom: 15.5%">
                <div class="justify-content-center">
                    <div class="col-md-12">
                        <div class="card mt-5">
                            <div class="card-header p-5">
                                <div class="col-md-12">
                                    <h1 style="font-weight: 200;">Ficha de Produto</h1>
                                </div>
                            </div>
                            <div class="card-body p-5">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Cod. Produto</th>
                                        <th scope="col">Designação</th>
                                        <th scope="col">Preço</th>
                                        <th scope="col">Qt. em stock</th>
                                        <th scope="col">Desconto</th>
                                    </tr>
                                    </thead>

                                    <tbody>


                                    <tr>
                                        <th>{{$produto->codProduto}}</th>
                                        <td>{{$produto->descricao}}</td>
                                        <td>{{$produto->preco}} &euro;</td>
                                        <td>{{$produto->quantidade_stock}}</td>
                                        @if($produto->promocao)
                                            <td>{{$produto->promocao->percentagem}} %</td>
                                        @else
                                            <td>Sem Promo</td>
                                        @endif
                                    </tr>

                                    </tbody>
                                </table>

                                <div class="form-group row">

                                    <a href="{{url()->previous()}}" role="button" style="padding: 5px">
                                        <button class="btn btn-danger">Voltar</button>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endif



@endsection
