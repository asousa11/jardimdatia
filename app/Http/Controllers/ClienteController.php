<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Sistema;
use App\Support\Collection;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
{
    /**
     * Mostra uma listagem de objetos do recurso.
     *
     * @param Sistema $sistema
     * @return Factory|View
     */
    public function index(Sistema $sistema)
    {
        $clientes = $sistema->getClienteHandler()->getClientes();
        $clientes = (new Collection($clientes))->paginate(10);
        return view('cliente.index',compact('clientes'));
    }

    /**
     * Mostra formuário para criar um novo recurso.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Guarda o novo recurso na BD
     *
     * @param Request $request
     * @param Sistema $sistema
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function store(Request $request, Sistema $sistema)
    {
        $request->validate([
            'contribuinte' => 'required | size:9',
            'nome' => 'required',
            'email' => 'required | email:rfc,dns',
            'morada' => 'required'
        ]);

        $sistema->getClienteHandler()->addCliente($request->contribuinte, $request->nome, $request->email, $request->morada , $request->cartaoOption);
        return redirect('/clientes');
    }

    /**
     * Mostra os atributos do recurso
     *
     * @param Sistema $sistema
     * @param Cliente $cliente
     * @return Application|Factory|View
     * @throws Exception
     */
    public function show(Sistema $sistema,Cliente $cliente)
    {
        $sistema->getClienteHandler()->verificaExisteCliente($cliente);
        $vendas = $sistema->getClienteHandler()->getUltimasVendas($cliente);
        return view('cliente.show',compact('cliente','vendas'));
    }

    /**
     * Mostra um formulário para edição do recurso
     *
     * @param Sistema $sistema
     * @param Cliente $cliente
     * @return Application|Factory|View
     * @throws Exception
     */
    public function edit(Sistema $sistema, Cliente $cliente)
    {
        $sistema->getClienteHandler()->verificaExisteCliente($cliente);
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Actualiza o recurso na BD
     *
     * @param Sistema $sistema
     * @param Cliente $cliente
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Sistema $sistema, Cliente $cliente)
    {
        request()->validate([
            'nome' => 'required',
            'email' => 'required | email:rfc,dns',
            'morada' => 'required'
        ]);

        $sistema->getClienteHandler()->updateCliente($cliente, request()->nome, request()->email, request()->morada, request()->cartaoOption);
        return redirect('/clientes');
    }

    /**
     * Remove o recurso na BD
     *
     * @param Sistema $sistema
     * @param Cliente $cliente
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Sistema $sistema, Cliente $cliente)
    {
        $sistema->getClienteHandler()->verificaExisteCliente($cliente);
        $sistema->getClienteHandler()->deleteCliente($cliente);
        return redirect('/clientes');
    }

    /**
     * Retorna clientes de acordo com o request
     * @param Request $request
     * @return Application|Factory|View
     */
    public function searchClient(Sistema $sistema, Request $request)
    {
        $search = $request->get('search');
        $clientes = $sistema->getClienteHandler()->searchCliente($search);
        if (count($clientes) == 0){
            return redirect(route('clientes.index'));
        }

        return view('cliente.index',compact('clientes'));
    }
}
