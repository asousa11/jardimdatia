<?php

namespace App\Http\Controllers;

use App\Sistema;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Chamado quando se pretende aceder à Homepage do cliente, enviando os produtos para serem mostrados na view.
     * @param Sistema $sistema
     * @return Application|Factory|View
     */
    public function index(Sistema $sistema)
    {
        $produtos = $sistema->getProdutoHandler()->getProdutos();
        return view('cliente.home',compact('produtos'));
    }
}
