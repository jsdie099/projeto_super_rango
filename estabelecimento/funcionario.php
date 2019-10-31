<?php
/**
 * Created by PhpStorm.
 * User: Juliano
 * Date: 27/03/2019
 * Time: 22:07
 */
class funcionario
{
    private $tipo;
    private $nome;
    private $cpf;


    public function setTipo($t)
    {
        $this->tipo=$t;
    }
    public function setNome($n)
    {
        $this->nome=$n;
    }
    public function setCpf($cpf)
    {
        $this->cpf=$cpf;
    }
    public function getTipo()
    {
        return $this->tipo;
    }

        public function getNome()
    {
        return $this->nome;
    }
    public function getCpf()
    {
        return $this->cpf;
    }


}

?>