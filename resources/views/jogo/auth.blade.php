@extends('layouts.layout')

@section('conteudo')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5" style="margin-bottom: 26%;">
                    <div class="card-header p-5">
                        <h1 style="font-weight: 200;">Quiz Semanal</h1>
                        <h6>Ganhe pontos e converta-os em saldo para utilizar no seu Jardim.</h6>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="/jogo/verification" method="post">
                            @csrf
                            {{--Campo Contribuinte--}}
                            <div class="form-group row">
                                <label for="text" class="col-md-2 col-form-label text-md-right">Contribuinte </label>

                                <div class="col-md-6">
                                    <input class="form-control @error('contribuinte') is-invalid alert @enderror"
                                           id="contribuinte"
                                           type="text"
                                           name="contribuinte"
                                           value="{{ old('contribuinte') }}"
                                           autofocus>

                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Jogar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
