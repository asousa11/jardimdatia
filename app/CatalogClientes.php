<?php


namespace App;

use Exception;

class CatalogClientes
{

    /**
     * CatalogClientes constructor.
     */
    public function __construct()
    {
    }

    /**
     * Adiciona Cliente caso este não se encontre ainda inserido e tenha um NIF válido
     * Caso contrário são lançadas Exceções
     *
     * @param int $numContribuinte
     * @param string $nome
     * @param string $email
     * @param string $morada
     * @param $cartaoOption
     * @throws Exception
     */
    public function addCliente(int $numContribuinte, string $nome, string $email, string $morada, $cartaoOption)
    {
        $in = Cliente::find($numContribuinte);
        if (!$in){
            $valid = $this->verificaContribuinte($numContribuinte);
        } else {
            throw new Exception("Cliente já se encontra inserido");
        }

        if (!$in && $valid){
            $cliente = new Cliente;
            $cliente->numContribuinte = $numContribuinte;
            $cliente->nome = $nome;
            $cliente->email = $email;
            $cliente->morada = $morada;
            $cliente->save();
            if ($cartaoOption == "sim") {
                $cartao = new CartaoCliente();
                $cartao->cliente()->associate($cliente);
                $cartao->save();
            }
        }else{
            throw new Exception("Contribuinte Inválido");
        }
    }

    /**
     * Verifica e retorna a validade de um NIF
     *
     * @param $numContribuinte
     * @return bool
     */
    public function verificaContribuinte($numContribuinte)
    {
        return (!is_null($numContribuinte) && strlen((string)$numContribuinte) == 9 && $numContribuinte % 2 == 0);
    }

    /**
     *Apaga o registo de cliente
     *Nota: Ao eliminar Cliente apaga o Cartão Cliente associado (cascade)
     *
     * @param $numContribuinte
     */
    public function deleteCliente($cliente)
    {
        $cliente->delete();
    }

    /**
     * Retorna todos os clientes
     *
     * @return Cliente[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getClientes()
    {
        return Cliente::all();
    }

    /**
     * Verifica a existência de um Cliente, mediante o numero de contribuinte
     * Lança uma exceção caso este não exista
     *
     * @param $cliente
     * @return mixed
     * @throws Exception
     */
    public function verificaExisteCliente($cliente)
    {
        $cliente = Cliente::find($cliente->numContribuinte);

        if (!$cliente){
            throw new Exception("Cliente Inexistente");
        }
    }
    /**
     * Verifica a existência de um Cliente válido para venda, mediante um NIF
     * Lança uma exceção caso este não exista cliente associado ao NIF
     *
     * @param $numContribuinte
     * @return mixed
     * @throws Exception
     */
    public function getCliente($numContribuinte)
    {
        $cliente = Cliente::find($numContribuinte);
        if ($cliente){
            return $cliente;
        }
        else {
            throw new Exception("Cliente Inexistente");
        }
    }

    /**
     * Actualiza atributos de um cliente, verificando ainda se foi ou não alterado a existencia do cartão cliente.
     *
     * @param \App\Cliente $cliente
     * @param string $nome
     * @param string $email
     * @param string $morada
     * @param $cartaoOption
     *
     */
    public function updateCliente(Cliente $cliente,string $nome, string $email, string $morada, $cartaoOption)
    {
        $cliente->nome = $nome;
        $cliente->email = $email;
        $cliente->morada = $morada;

        if($cliente->cartao  && $cartaoOption != "sim"){
            $cartao = $cliente->cartao;
            $cartao->delete();
        }
        elseif (!$cliente->cartao && $cartaoOption == "sim"){
            $cartao = new CartaoCliente();
            $cartao->cliente()->associate($cliente);
            $cartao->save();
        }
        $cliente->update();
    }

    /**
     * Obtem as ultimas 10 vendas do Cliente
     *
     * @param \App\Cliente $cliente
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUltimasVendas(Cliente $cliente)
    {
        $vendas = $cliente->vendas()->latest()->limit(10)->get();

//        $vendas = $user = DB::table('vendas')
//            ->where('numContribuinte', $numContribuinte)
//            ->latest()
//            ->limit(10)
//            ->get();

        return $vendas;
    }

    /**
     * Adiciona pontos ao Cartão Cliente e actualiza saldo disponivel em cartao, caso total de pontos já tenham chegado aos 10 pontos
     *
     * @param $cliente
     */
    public function adcionarPontos($cliente)
    {
        $cliente->cartao->pontosDisponiveis += 1;
        if ($cliente->cartao->pontosDisponiveis >= 10) {
            $cliente->cartao->pontosDisponiveis -= 10;
            $cliente->cartao->saldoacumulado += 1;
        }
        $cliente->cartao->save();
    }

    /**
     * Actualiza data em que foi efetuado um jogo
     *
     * @param $cliente
     */
    public function updateQuizDate($cliente)
    {
        $cliente->cartao->lastQuiz = (int) date('W');
        $cliente->cartao->save();
    }

    /**
     * Retorna clientes de acordo com o parametro
     *
     * @param $search
     * @return mixed
     */
    public function searchCliente($search)
    {
        return Cliente::where('nome','like','%'.$search.'%')->paginate(10);
    }
}
