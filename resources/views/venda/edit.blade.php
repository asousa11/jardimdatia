@extends('layouts.layout')

@section('conteudo')
    <div class="container" style="padding-bottom: 15.5%">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Venda | {{$venda->id}} <br> Data | {{$venda->created_at->format('d-m-Y')}}</div>

                    <a href="/vendas/{{$venda->id}}/addProduto ">
                        <button type="button" class="btn btn-primary">Adicionar Produtos</button>
                    </a>

                    <div class="card-body">
                        <form action="{{route('vendas.update',$venda) }}" method="post">
                            @csrf
                            {{method_field('put')}}

                            {{--Campo Estado--}}
                            <div class="form-group row">
                                <label for="estado" class="col-md-2 col-form-label text-md-right">Estado </label>

                                @if(!$venda->aberta)
                                    <div class="col-md-6">
                                        <input type="checkbox" id="estado" name="estado" value="sim" checked>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <input type="checkbox" id="estado" name="estado" value="sim">
                                    </div>
                                @endif
                            </div>

                            {{--Campo Total--}}
                            <div class="form-group row">
                                <label for="total" class="col-md-2 col-form-label text-md-right">Total </label>

                                <div class="col-md-4">
                                    <input id="total" type="text" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ $venda->total }} €" readonly autofocus>
                                </div>
                            </div>

                            {{--Campo Total Desconto--}}
                            <div class="form-group row">
                                <label for="desconto" class="col-md-2 col-form-label text-md-right">Total Desconto </label>

                                <div class="col-md-4">
                                    <input id="desconto" type="text" class="form-control @error('desconto') is-invalid @enderror" name="desconto" value="{{ $venda->descontoTotal }} €" readonly autofocus>
                                </div>
                            </div>

                            {{--Campo Total Global--}}
                            <div class="form-group row">
                                <label for="totalGlobal" class="col-md-2 col-form-label text-md-right">Total Global </label>

                                <div class="col-md-4">
                                    <input id="totalGlobal" type="text" class="form-control @error('totalGlobal') is-invalid @enderror" name="totalGlobal" value="{{ $venda->total - $venda->descontoTotal }} €" readonly autofocus>
                                </div>
                            </div>

                            <hr>

                            {{--Campo Contribuinte--}}
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Nº Contribuinte </label>

                                <div class="col-md-4">
                                    <input id="contribuinte" type="text" class="form-control @error('contribuinte') is-invalid @enderror" name="contribuinte" value="{{ $venda->cliente->numContribuinte }}" readonly autofocus>

                                </div>
                            </div>

                            {{--Campo Nome--}}
                            <div class="form-group row">
                                <label for="nome" class="col-md-2 col-form-label text-md-right">Nome </label>

                                <div class="col-md-6">
                                    <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ $venda->cliente->nome }}" readonly autofocus>
                                </div>
                            </div>

                            {{--Campo Email--}}
                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Email </label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $venda->cliente->email }}" readonly autofocus>
                                </div>
                            </div>

                            {{--Campo Morada--}}
                            <div class="form-group row">
                                <label for="morada" class="col-md-2 col-form-label text-md-right">Morada </label>

                                <div class="col-md-6">
                                    <input id="morada" type="text" class="form-control @error('morada') is-invalid @enderror" name="morada" value="{{ $venda->cliente->morada }}" readonly autofocus>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
