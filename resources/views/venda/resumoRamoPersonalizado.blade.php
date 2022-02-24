    @extends('layouts.layout')

@section('conteudo')
    <div class="container" style="padding-bottom: 15.5%">
        <div class="justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header p-5">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Resumo Ramo Personalizado</h1>
                            </div>
                            <div class="col-md-2">
                                Venda<h1 style="font-weight: 700">{{$venda->id}}</h1>
                            </div>
                            <div class="col-md-2">
                                Ramo<h1 style="font-weight: 700">{{$ramo->codProduto}}</h1>
                            </div>
                            <div class="col-md-10">
                                Data <h1 style="font-weight: 700">{{$venda->created_at->format('d-m-Y')}}</h1>
                            </div>
                        </div>
                    </div>


                    <div class="card-body p-5">

{{--                        <div class="form-group row">--}}
{{--                            <label for="nome">Total:</label>--}}
{{--                            <label style="margin-left: 2%;">{{number_format($ramo->preco,2)}} &euro;</label>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="nome">Desconto Ramo:</label>--}}
{{--                            <label style="margin-left: 2%;">{{number_format($ramo->preco * $ramo->promocao->percentagem / 100 ,2)}} &euro;</label>--}}

{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="nome">Total Global:</label>--}}
{{--                            <label style="margin-left: 2%;">{{number_format($ramo->preco - ($ramo->preco * $ramo->promocao->percentagem / 100),2)}} &euro;</label>--}}
{{--                        </div>--}}

{{--                        <hr>--}}

                        <div class="form-group row">
                            <label for="nome">Cliente:</label>
                            <label style="margin-left: 2%;">{{$venda->cliente->nome}}</label>
                        </div>

                        <div class="form-group row">
                            <label for="contribuinte">Contribuinte:</label>
                            <label style="margin-left: 2%;">{{$venda->cliente->numContribuinte}}</label>
                        </div>

                        <div class="form-group row">
                            <label for="email">Email:</label>
                            <label style="margin-left: 2%;">{{$venda->cliente->email}}</label>
                        </div>

                        <div class="form-group row">
                            <label for="morada">Morada:</label>
                            <label style="margin-left: 2%;">{{$venda->cliente->morada}}</label>
                        </div>

                        {{--                        Tabela --}}

                        <table class="table">

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
                            @foreach($ramo->artigoRamo as $ar)
                                <tr>
                                    <td>{{$ar->codProduto}}</td>
                                    <td>{{$ar->descricao}}</td>
                                    <td>{{number_format($ar->preco_artigo_uni,2)}} &euro;</td>
                                    <td>{{$ar->quantidade}} Und.</td>
                                    <td>{{number_format($ar->preco_artigo_uni * $ar->quantidade,2)}} &euro;</td>
                                    @if($ar->percentagemPromo != null)
                                        <td>{{number_format($ar->preco_artigo_uni * $ar->quantidade * $ar->percentagemPromo / 100,2)}} &euro;</td>
                                        <td style="background: #00AAAA; color: white">{{number_format(($ar->preco_artigo_uni * $ar->quantidade) - ($ar->preco_artigo_uni * $ar->quantidade * $ar->percentagemPromo / 100),2)}} &euro;</td>
                                    @else
                                        <td>0 &euro;</td>
                                        <td style="background: #00AAAA; color: white">{{$ar->preco_artigo_uni * $ar->quantidade}} &euro;</td>
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
                                <td><strong>{{number_format($ramo->preco,2)}} &euro;</strong></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color: red"><strong>Desconto de Ramo :</strong></td>
                                <td><strong>{{number_format($ramo->preco * $ramo->promocao->percentagem / 100 ,2)}} &euro;</strong></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color: red"><strong>Total Líquido :</strong></td>
                                <td><strong>{{number_format($ramo->preco - ($ramo->preco * $ramo->promocao->percentagem / 100),2)}} &euro;</strong></td>

                            </tr>

                            </tbody>

                        </table>



                        <div class="form-group row">

                            <a href="{{route('finalizarRamoPersonalizado',[$venda,$ramo])}}" style="padding: 5px">
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
    </div>
@endsection
