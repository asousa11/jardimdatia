@extends('layouts.layout')

@section('conteudo')

    <div class="container">
        <div class="justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5 mb-5">
                    <div class="card-header p-5">
                       <h1 style="font-weight: 200;">Criar Venda</h1>
                    </div>
                    <div class="card-body">
                        <form action="/vendas" method="post">
                            @csrf

                            {{--Campo Contribuinte--}}
                            <div class="form-group row mt-2">
                                <label for="text" class="col-md-2 col-form-label text-md-right">Contribuinte </label>

                                <div class="col-md-4">
                                    <input class="form-control @error('contribuinte') is-invalid @enderror"
                                           id="contribuinte"
                                           type="text"
                                           name="contribuinte"
                                           value="{{ old('contribuinte') }}"
                                           autofocus>

                                    @error('contribuinte')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <button type="submit" class="btn btn-primary">Adicionar</button>
                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
