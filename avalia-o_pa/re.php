<?php

abstract class Cliente{
    protected  string $email;
    private string $cpf;
    private string $nome;
    public string $tipo;
    public float $gasto = $gasto;
    private string $endereco;

    function __construct(string $email, string $cpf, string $nome, string $tipo, float $gasto, string $endereco){
        $this->email  = $email;
        $this->cpf   = $cpf;
        $this->nome = $nome;
        $this->tipo  = $tipo;
        $this->gasto   = $gasto;
        $this->endereco = $endereco;

    }

    abstract function desconto();
}
  class ClienteComum extends Cliente{
    function __construct( $nome,$email,$cpf,$endereco){
        parent:: __construct($nome,$email,$cpf,$endereco,"comum");
    }
    function desconto(){return 0;}
}
  class ClientePremium extends Cliente{
    function __construct($nome,$email,$cpf,$endereco){
       parent :: __construct($nome,$email,$cpf,$endereco, "premium");
    }
    function desconto() {return 0.15;}
    }

   class Produto{
    private string $nome;
    private float $preco;
    private int $estoque;

    function __construct($nome,$preco,$estoque){
        $this->nome  = $nome;
        $this->preco   = $preco;
        $this->estoque = $estoque;
    }
    function Nome(){ return $this->nome;}
    function Preco(){ return $this->preco;}
    function Estoque(){ return $this->estoque;}

    public function reduzirEstoque (int $qnt):void{
        if($qnt > $this->estoque){
            
        }
    }




        
    }
       
   } 
   

    


     

