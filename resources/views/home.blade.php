@extends('layouts.layout')

@section('conteudo')


    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="jumbotron-fluid " style="background-image: url(/images/carousel1.jpg); background-attachment: fixed; background-position: top; padding: 5%;">
            <div class="container text-center text-white">
                <h1 style="font-weight: 300;">Bem-vindo ao sistema de gestão - Jardim da Tia</h1>
            </div>

        </div>
            <div class="container mt-5" style="margin-bottom: 5%;">
                <h1 class="text-center mb-5" style="font-weight: 200;">Escolha a secção que pretende</h1>
                <div class="row text-center text-white" >
                    <a class="col-md-4 bg-dark" href="/clientes" style="color: white;text-decoration: none;padding: 3%;">
                            <i class="fas fa-user" style="font-size: 26px;margin-bottom: 2%"></i>
                            <h3 style="font-weight: 300;"> Gerir Clientes</h3>
                       </a>
                    <a class="col-md-4 bg-dark" href="/vendas" style="color: white;text-decoration: none;padding: 3%;">
                        <i class="fas fa-euro-sign" style="font-size: 26px;margin-bottom: 2%"></i>
                        <h3 style="font-weight: 300;"> Processar Venda</h3>
                    </a>
                    <a class="col-md-4 bg-dark" href="/premios" style="color: white;text-decoration: none;padding: 3%; ">
                        <i class="fas fa-award" style="font-size: 26px;margin-bottom: 2%"></i>
                        <h3 style="font-weight: 300;">Modificar Prémio</h3>
                    </a>
                </div>
            </div>



@endsection
