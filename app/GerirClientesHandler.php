<?php


namespace App;

class GerirClientesHandler
{

    private CatalogClientes $catalogCliente;

    /**
     * ClienteHandler constructor.
     */
    public function __construct(CatalogClientes $catalogClientes)
    {
        $this->catalogCliente = $catalogClientes;
    }

    /**
     * Obtem todos os clientes
     *
     * @return Cliente[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getClientes()
    {
        return $this->catalogCliente->getClientes();
    }

    public function getCliente($numContribuinte)
    {
        return $this->catalogCliente->getCliente($numContribuinte);
    }

    /**
     * Adiciona no cliente na BD
     *
     * @param int $numContribuinte
     * @param string $nome
     * @param string $email
     * @param string $morada
     * @param $cartaoOption
     * @throws \Exception
     */
    public function addCliente(int $numContribuinte, string $nome, string $email, string $morada, $cartaoOption)
    {
        $this->catalogCliente->addCliente($numContribuinte, $nome, $email,$morada, $cartaoOption);
    }

    /**
     * Verifica se existe o cliente, ao verificar atributos do objeto
     *
     * @param $cliente
     * @throws \Exception
     */
    public function verificaExisteCliente($cliente)
    {
        $this->catalogCliente->verificaExisteCliente($cliente);
    }

    /**
     * Apaga o registo de CLiente, mediante a existencia do mesmo
     *
     * @param Cliente $cliente
     */
    public function deleteCliente(Cliente $cliente)
    {
        $this->verificaExisteCliente($cliente);
        $this->catalogCliente->deleteCliente($cliente);
    }

    /**
     *Actualiza atributos do Cliente, mediante a existencia do mesmo
     *
     * @param Cliente $cliente
     * @param string $nome
     * @param string $email
     * @param string $morada
     * @param $cartaoOption
     */
    public function updateCliente(Cliente $cliente, string $nome, string $email, string $morada, $cartaoOption)
    {
        $this->verificaExisteCliente($cliente);
        $this->catalogCliente->updateCliente($cliente,$nome,$email,$morada,$cartaoOption);
    }

    /**
     * Obtem ultimas Vendas de cliente
     *
     * @param Cliente $cliente
     * @return mixed
     */
    public function getUltimasVendas(Cliente $cliente)
    {
        return $this->catalogCliente->getUltimasVendas($cliente);
    }

    /**
     * Adiciona Pontos a Cartao Cliente de Cliente
     *
     * @param $cliente
     */
    public function adicionarPontos($cliente)
    {
        $this->catalogCliente->adcionarPontos($cliente);
    }

    /**
     *Actualiza a data do ultimo jogo feito pelo cliente
     *
     * @param $cliente
     */
    public function updateQuizDate($cliente)
    {
        $this->catalogCliente->updateQuizDate($cliente);
    }

    /**
     * Retorna clientes de acordo com o parametro
     * @param $search
     */
    public function searchCliente($search)
    {
        return $this->catalogCliente->searchCliente($search);
    }

}
