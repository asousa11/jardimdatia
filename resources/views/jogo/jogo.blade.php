@extends('layouts.layout')

@section('conteudo')

    <div class="container" id="container">
        <div id="start" onclick="startQuiz()">
                <div class="d-flex justify-content-center">
                    <div class="d-flex align-items-center">
                        <h1 style="font-weight: 200">Start Quiz!</h1>
                    </div>
                </div>
        </div>

        <div class="d-flex justify-content-center">
            <div  id="qImage" style="display: none">
            </div>
        </div>

        <div id="quiz" style="display: none">

                <div class="col-xl-12 text-center" id="question">
                </div>

            <div class="row">
                        <div class="col-xl-12 text-center" id="choices">
                            <div class="row">
                        <button id="A" class="col-md-3 choice" data-toggle="modal" data-target="#exampleModalCenter" onclick="checkAnswer('A', {{$cliente->numContribuinte}})"></button>
                        <button id="B" class="col-md-3 choice" data-toggle="modal" data-target="#exampleModalCenter" onclick="checkAnswer('B', {{$cliente->numContribuinte}})"></button>
                        <button id="C" class="col-md-3 choice" data-toggle="modal" data-target="#exampleModalCenter" onclick="checkAnswer('C', {{$cliente->numContribuinte}})"></button>
                        <button id="D" class="col-md-3 choice" data-toggle="modal" data-target="#exampleModalCenter" onclick="checkAnswer('D', {{$cliente->numContribuinte}})"></button>
                    </div>

                </div>
            </div>

        </div>

    </div>
    </div>
    <script src="/assets/js/jogo.js">
    </script>
    {{--    @endif--}}
@endsection

