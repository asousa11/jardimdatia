@extends('layouts.layout')

@section('conteudo')
    <div class="container" style="padding-bottom: 8%">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header p-5">
                        <h1 style="font-weight: 200">Prémio por Volume de Compra</h1>
                    </div>
                    <div class="card-body">
                        <form action="/premios" method="post">
                            @csrf
                            {{method_field('put')}}

                            {{--Campo Volume de Compras--}}
                            <div class="form-group row">
                                <label for="volume" class="col-md-2 col-form-label text-md-right">Volume de Compra para Prémio</label>

                                <div class="col-md-6">
                                    <input id="volume" type="text" class="form-control" name="volume" value="{{ $premio->volumeNegocio }}">

                                </div>
                            </div>

                            {{--Campo Premio--}}
                            <div class="form-group row">
                                <label for="premio" class="col-md-2 col-form-label text-md-right"> Prémio de Compra </label>

                                <div class="col-md-6">
                                    <input id="premio" type="text" class="form-control" name="premio" value="{{ $premio->oferta }}">
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
