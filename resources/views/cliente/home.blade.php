@extends('layouts.sitelayout')

@section("conteudo")


<div id="carousel" class="carousel slide" data-ride="carousel">

    <!--Indicadores-->
    <ul class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
{{--        <li data-target="#carousel" data-slide-to="2"></li>--}}
    </ul>

    <!--Imagens do Carousel-->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/images/carousel1.jpg" alt="carousel1">
            <div class="carousel-caption" style="top:30%;">
                <h1 style="font-size: 48pt; font-weight: 200;">Promoção Início do Verão</h1>
                <h3>De 20 de junho até 10 de agosto</h3>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/images/carousel2.jpg" alt="carousel2">
            <div class="carousel-caption" style="top:30%;">
                <h1 style="font-size: 48pt; font-weight: 200;">Promoção de Verão</h1>
                <h3>De 20 de junho até 20 de setembro</h3>
            </div>
        </div>
{{--        <div class="carousel-item">--}}
{{--            <img src="/images/carousel3.jpg" alt="carousel3">--}}
{{--            <div class="carousel-caption" style="top:30%;">--}}
{{--                <h1 style="font-size: 48pt; font-weight: 200;">Promoção Verão</h1>--}}
{{--                <h3>De 20 de junho até 30 de junho</h3>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

    <!--Seta Direita e Esquerda-->
    <a class="carousel-control-prev" href="#carousel" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#carousel" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>

<div class="container">
        <h1 class="title" style="font-weight: 200;margin-top: 5%;margin-bottom: 2.5%">Destaques</h1>
    <div class="row">
        @foreach($produtos as $produto)
            @if($produto->promocao)
                <div class="col-md-3 mt-5">
                    <div class="card bg-dark text-white">
                        <img class="card-img-top" src="{{$produto->image_path}}" alt="Card image cap">
                        <div class="card-body">
                            <span class="badge badge-success">{{$produto->promocao->percentagem}}%</span>
                            <div class="row">
                                <div class="col-lg-8">
                                    <h6 class="card-title" style="font-weight: 200;">{{$produto->descricao}}</h6>
                                </div>
                                @if($produto->promocao)
                                    <div class="col-lg-4 text-right">
                                        <s><h6 style="font-weight: 500;">{{$produto->preco}} &euro;</h6></s>
                                    </div>
                                    <div class="col-lg-5">
                                        <h5 style="font-weight: 500;">{{number_format($produto->preco * (1-($produto->promocao->percentagem/100)),2)}} &euro;</h5></s>
                                    </div>
                                @else
                                    <div class="col-lg-4 text-right">
                                        <h5 style="font-weight: 500;">{{$produto->preco}} &euro;</h5>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            @endif
        @endforeach
    </div>
    <h1 class="title" style="font-weight: 200;margin-top: 5%;margin-bottom: 5%">Flores da Época</h1>
    <div class="row">
        @foreach($produtos as $produto)
            @if(class_basename($produto) == 'Flor' && (now() > $produto->epoca->datainicio && now() < $produto->epoca->datafim))
                <div class="col-md-3">
                    <div class="card bg-dark text-white">
                        <img class="card-img-top" src="{{$produto->image_path}}" alt="Card image cap">
                        <div class="card-body">
                            @if($produto->promocao)
                            <span class="badge badge-success">{{$produto->promocao->percentagem}}%</span>
                            @endif
                            <div class="row">
                                <div class="col-lg-8">
                                    <h6 class="card-title" style="font-weight: 200;">{{$produto->descricao}}</h6>
                                </div>
                                @if($produto->promocao)
                                    <div class="col-lg-4 text-right">
                                        <s><h6 style="font-weight: 500;">{{$produto->preco}} &euro;</h6></s>
                                    </div>
                                    <div class="col-lg-5">
                                        <h5 style="font-weight: 500;">{{number_format($produto->preco * (1-($produto->promocao->percentagem/100)),2)}} &euro;</h5></s>
                                    </div>
                                @else
                                    <div class="col-lg-4 text-right">
                                        <h5 style="font-weight: 500;">{{$produto->preco}} &euro;</h5>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        @endforeach
    </div>



    <h1 class="title" style="font-weight: 200;margin-top: 5%;margin-bottom: 5%">Ocasiões</h1>
    <div class="row">
        @foreach($produtos as $produto)
            @if($produto->ocasiao && now() > $produto->ocasiao->datainicio && now() < $produto->ocasiao->datafim)
                <div class="col-md-3">
                    <div class="card bg-dark text-white">
                        <img class="card-img-top" src="{{$produto->image_path}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$produto->descricao}}</h5>
                            <span class="badge badge-primary">{{$produto->ocasiao->designacao}}</span>
                        </div>
                    </div>

                </div>
            @endif
        @endforeach
    </div>
    </div>
</div>



    <div class="contacts bg-dark text-white mt-5" id="contatos">
        <div class="container pb-5">
            <h1 style="font-weight: 200;padding-top: 5%; margin-bottom: 2.5%;">Contatos</h1>
            <div class="row text-center p-5">
                <div class="col-md-4">
                        <i class="fas fa-map-marker-alt mb-3" style="background-color: #6bbf3d;padding: 3.5%; border-radius: 50px;"></i>
                    <p>Rua dos Lírios, nº18 - 9500-469</p>
                    <p class="mb-md-0">Ponta Delgada, São Miguel, Açores</p>
                </div>
                <div class="col-md-4">
                        <i class="fas fa-phone mb-3" style="background-color: #6bbf3d;padding: 3.5%; border-radius: 50px;"></i>
                    <p>+ 351 296 123 456</p>
                    <p class="mb-md-0">Seg - Sáb, 8:30-20:00</p>
                </div>
                <div class="col-md-4">
                        <i class="fas fa-envelope mb-3" style="background-color: #6bbf3d;padding: 3.5%; border-radius: 50px;"></i>
                    <p class="mt-4 mb-0">geral@jardimdatia.com</p>
                </div>
            </div>
        </div>
        </div>
<div class="aboutus text-white" id="sobrenos"style="background-color: #6bbf3d;">
    <div class="container pb-5">
        <h1 style="font-weight: 200;padding-top: 5%; margin-bottom: 2.5%;">Sobre Nós</h1>
        <div class="text-center p-5">
            <h3>Jardim da Tia: Líder em venda de flores ao domicílio</h3>
            <p>  Todas as nossas flores e plantas são preparadas no dia da entrega por um dos nossos floristas localizados de norte a sul de Portugal e em mais de 150 países para o transporte internacional.
                Lembre-se que tem a garantia de serviço e qualidade de uma empresa que trabalha há mais de 65 anos com entregas de flores ao domicílio.</p>
            <p>
            <p>No Jardim da Tia vai encontrar uma grande selecção de flores, arranjos feitos à mão e encantadores centros de flores que vão causar o deleite de todos. A promoção de floristas locais é muito importante para o Jardim da Tia, pois sem a nossa grande rede de floristas não seriamos capazes de poder enviar as flores mais bonitas em todo o mundo. Adoramos as nossas flores, e por isso fazemos o possível para que as novas tendências em arranjos florais possam aparecer nos nossos catálogos.</p>


                No Jardim da tia também vai encontrar toda a classe de centros e cestos de plantas de diferentes tamanhos e formatos para qualquer ocasião. Surpreenda alguém especial enviando uma das plantas preparadas com toda a atenção de um dos nossos floristas. Enviar plantas online nunca foi tão fácil como agora. Se não tem tempo para comprar flores ou plantas na florista do seu bairro, nós ajudamo-lo e levamos-lhe o florista onde esteja.</p>

        </div>
    </div>
</div>



@endsection






