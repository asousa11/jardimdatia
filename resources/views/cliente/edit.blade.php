@extends('layouts.layout')

@section('conteudo')
    <div class="container" style="padding-bottom: 16.4%">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header p-5">
                        <h2 style="font-weight: 700">Edição | {{$cliente->nome}}</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{route('clientes.update',$cliente) }}" method="post">
                            @csrf
                            {{method_field('put')}}


                            {{--Campo Contribuinte--}}
                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Contribuinte </label>

                                <div class="col-md-6">
                                    <input id="contribuinte" type="text" class="form-control @error('contribuinte') is-invalid @enderror" name="contribuinte" value="{{ $cliente->numContribuinte }}" readonly autofocus>

                                    @error('contribuinte')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--Campo Nome--}}
                            <div class="form-group row">
                                <label for="nome" class="col-md-2 col-form-label text-md-right">Nome </label>

                                <div class="col-md-6">
                                    <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ $cliente->nome }}" required autofocus>

                                    @error('nome')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--Campo Email--}}
                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Email </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $cliente->email }}" required autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--Campo Morada--}}
                            <div class="form-group row">
                                <label for="morada" class="col-md-2 col-form-label text-md-right">Morada </label>

                                <div class="col-md-6">
                                    <input id="morada" type="text" class="form-control @error('morada') is-invalid @enderror" name="morada" value="{{ $cliente->morada }}" required autofocus>

                                    @error('morada')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--Checkbox Cartão Cliente--}}
                            <div class="form-group row">
                                <label for="cartao" class="col-md-2 col-form-label text-md-right">Cartão Cliente?</label>
                                <div class="col-md-6">
                                    @if($cliente->cartao)
                                        <input type="checkbox" id="cartao" name="cartaoOption" value="sim" checked>
                                    @else
                                        <input type="checkbox" id="cartao" name="cartaoOption" value="sim">
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-left">Update</button>
                        </form>

                        <a href="{{url()->previous()}}" role="button">
                            <button class="btn btn-danger ml-1">Voltar</button>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
