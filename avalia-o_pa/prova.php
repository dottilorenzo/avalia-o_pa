<?php

abstract class Cliente {
    protected string $email;
    private string $cpf;
    private string $nome;
    public string $tipo;
    public float $gasto = 0; // Initialize gasto to 0
    private string $endereco;

    function __construct(string $nome, string $email, string $cpf, string $tipo, string $endereco) {
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->tipo = $tipo;
        $this->endereco = $endereco;
    }

    abstract function desconto();

    public function registrarGasto(float $valor) {
        $this->gasto += $valor; 
    }

    public function getGastoTotal(): float {
        return $this->gasto;
    }

    public function getNome(): string {
        return $this->nome; 
    }
}

class ClienteComum extends Cliente {
    function __construct(string $nome, string $email, string $cpf, string $endereco) {
        parent::__construct($nome, $email, $cpf, "comum", $endereco);
    }

    function desconto(): float {
        return 0;
    }
}

class ClientePremium extends Cliente {
    function __construct(string $nome, string $email, string $cpf, string $endereco) {
        parent::__construct($nome, $email, $cpf, "premium", $endereco);
    }

    function desconto(): float {
        return 0.15;
    }
}

class Produto {
    private string $nome;
    private float $preco;
    private int $estoque;

    public function __construct(string $nome, float $preco, int $estoque) {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->estoque = $estoque;
    }

    public function Nome(): string {
        return $this->nome;
    }

    public function Preco(): float {
        return $this->preco;
    }

    public function reduzirEstoque(int $quantidade) {
        if ($quantidade > $this->estoque) {
            throw new Exception("Estoque insuficiente");
        }
        $this->estoque -= $quantidade;
    }
}

class ItemPedido {
    private Produto $produto;
    private int $quantidade;

    public function __construct(Produto $produto, int $quantidade) {
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->produto->reduzirEstoque($quantidade); // Reduz estoque no momento da criação
    }

    public function calcularSubtotal(): float {
        return $this->produto->Preco() * $this->quantidade;
    }
}

class Pedido {
    private Cliente $cliente;
    private array $itens = [];
    private string $status;

    public function __construct(Cliente $cliente) {
        $this->cliente = $cliente;
        $this->status = "Aberto"; // Status inicial
    }

    public function adicionarItem(Produto $produto, int $quantidade) {
        $this->itens[] = new ItemPedido($produto, $quantidade);
    }

    public function calcularTotal(): float {
        $total = 0;
        foreach ($this->itens as $item) {
            $total += $item->calcularSubtotal();
        }
        return $total;
    }

    public function finalizarPedido(): float {
        $total = $this->calcularTotal();
        $totalFinal = $total - ($total * $this->cliente->desconto());
        $this->cliente->registrarGasto($totalFinal);
        $this->status = "Pago"; 
        return $totalFinal;
    }

    public function getStatus(): string {
        return $this->status;
    }
}

// Criação de clientes
$dotti = new ClienteComum("Dotti", "dotti@email.com", "90984638", "Rua B");
$penna = new ClientePremium("Penna", "penna@email.com", "907654321", "Rua C");

// Criação de produtos
$camiseta = new Produto("Camiseta", 150, 14);
$moletom = new Produto("Moletom", 200, 50);

// Criar pedidos
$pedidoDotti = new Pedido($dotti);
$pedidoDotti->adicionarItem($camiseta, 1);
$pedidoDotti->adicionarItem($moletom, 2);

$pedidoPenna = new Pedido
       
   

    


     

