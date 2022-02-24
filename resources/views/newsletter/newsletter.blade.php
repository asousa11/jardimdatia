@extends('layouts.newsletterlayout')

@section('conteudo')


<div class="jumbotron-fluid" style="background: url('/images/carousel1.jpg');padding: 5%">
    <div class="container text-center">
        <h1 style="font-weight: 200; color: white; font-size: 48pt">Newsletter - {{$epoca->designacao}}</h1>
    </div>
</div>

<div class="container" style="margin-top: 2.5%;">
    <h1 style="font-weight: 200;">Promoções</h1>
    @foreach($promocoes as $promocao)
        @if($promocao->id != 9)
            <h5 style="padding:2% 0% 2% 0%; margin-top: 3%;">{{$promocao->descricao}}</h5>
        @endif
        <div class="row">
        @foreach($promocao->produtos() as $produto)
           @if($produto->personalizavel == false)
                <div class="col-md-3">
                    <div class="card bg-dark text-white" style="margin-bottom: 5%">
                        <img src="{{$produto->image_path}}" style="height: 250px">
                        <div class="card-body">
                            <span class="badge badge-success">{{$produto->promocao->percentagem}}%</span>
                            <div class="row">
                                <div class="col-lg-8">
                                    <h6 class="card-title" style="font-weight: 200;">{{$produto->descricao}}</h6>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <s><h6 style="font-weight: 500;">{{number_format($produto->preco * (1-($produto->promocao->percentagem/100)),2)}} &euro;</h6></s>
                                </div>
                                <div class="col-lg-4">
                                    <h6 style="font-weight: 500;">{{$produto->preco}} &euro;</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    @endforeach

    <h1 style="font-weight: 200;margin-top: 5%;padding:2% 0% 2% 0%;">Sugestões da Época</h1>
    <div class="row" style="margin-bottom: 5%;">
        @foreach($sugestoes as $sugestao)
            <div class="col-md-4">
                <div class="card bg-dark text-white" style="margin-bottom: 5%">
                    <div class="card-header">
                        <h3 style="font-weight: 200;">{{$sugestao->tipo}}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{$sugestao->texto}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>

@endsection

