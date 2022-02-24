<?php

namespace App\Http\Controllers;

use App\Sistema;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

/**
 * Class JogoController
 * @package App\Http\Controllers
 */
class JogoController extends Controller
{
    /**
     * Redireciona para a view 'jogo.auth' onde o cliente deve inserir o seu NIF para posterior autenticação.
     * @return Application|Factory|View
     */
    public function autenticar()
    {
        return view('jogo.auth');
    }

    /**
     * Verifica se o tem as condições necessárias para jogar o Quiz.
     * @param Sistema $sistema
     * @param Request $request
     * @return Application|Factory|RedirectResponse|View
     */
    public function verificarAut(Sistema $sistema, Request $request)
    {

        request()->validate([
            'contribuinte' => 'required | size:9'
        ]);

        $cliente = $sistema->getClienteHandler()->getCliente($request->contribuinte);


        if ($cliente->cartao){
            if ($cliente->cartao->lastQuiz < (int) date('W')){
                return view('jogo.jogo', compact('cliente'));
            }else{
                return Redirect::back()->withErrors('Já esgotou as suas tentativas semanais.');
            }
        }else{
            return Redirect::back()->withErrors('Para jogar necessita de ter cartão cliente.');
        }
    }

    /**
     * Atualiza os pontos do cliente, caso seja esse o caso.
     * Marca também o cliente como já tendo respondido ao Quiz semanal.
     * @param Sistema $sistema
     * @param $contribuinte
     * @param $resultado
     * @return Application|RedirectResponse|Redirector
     */
    public function updatePontos(Sistema $sistema, $contribuinte, $resultado)
    {
        $cliente = $sistema->getClienteHandler()->getCliente($contribuinte);
        $sistema->getClienteHandler()->updateQuizDate($cliente);

        if ($resultado == "certo")
            $sistema->getClienteHandler()->adicionarPontos($cliente);

        return \redirect('/home');
    }
}
