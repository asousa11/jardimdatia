<?php

namespace App\Http\Controllers;

use App\Sistema;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class PremioController
 * @package App\Http\Controllers
 */
class PremioController extends Controller
{
    /**
     * Método que retorna um formulário para edição do Prémio para o cliente consoante o Volume de Negócio.
     * @param Sistema $sistema
     * @return Application|Factory|View
     */
    public function editar(Sistema $sistema)
    {
        $premio = $sistema->getPremioHandler()->getPremio();
        return view('premio.edit', compact('premio'));
    }

    /**
     * Função que, após submissão do formulário, atualiza o Volume de Negócio e respetivo Prémio.
     * @param Sistema $sistema
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Sistema $sistema, Request $request)
    {
        $sistema->getPremioHandler()->updatePremio($request->volume, $request->premio);
        return redirect('/admin');
    }
}
