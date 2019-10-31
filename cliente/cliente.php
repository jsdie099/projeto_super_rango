<?php
/**
 * Created by PhpStorm.
 * User: Juliano
 * Date: 01/04/2019
 * Time: 20:35
 */

class Cliente
{
    private $nomecli;
    private $cpfcli;
    private $numCel;
    private $email;
    private $rua;
    private $bairro;
    private $numero;
    private $complemento;
    private $cidade;
    private $cep;


        public function setNomeCli($nomec)
    {
        $this->nomecli = $nomec;
    }
        public function setCpfCli($cpfc)
    {
        $this->cpfcli = $cpfc;
    }
        public function getNomeCli()
    {
        return addslashes($this->nomecli);
    }
    public function getCpfCli()
    {
        return $this->cpfcli;
    }

    public function setNumCel($numCel)
    {
        $this->numCel = $numCel;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setRua($rua)
    {
        $this->rua = $rua;
    }
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }
    public function setCep($cep)
    {
        $this->cep = $cep;
    }
    public function getNome()
    {
        return    $this->nomecli;
    }

    public function getCpf()
    {
        return    $this->cpfcli;
    }
    public function getNumCel()
    {
        return  $this->numCel;
    }
    public function getEmail()
    {
        return  $this->email;
    }
    public function getRua()
    {
        return  $this->rua;
    }
    public function getBairro()
    {
        return  $this->bairro;
    }
    public function getNumero()
    {
        return  $this->numero;
    }

    public function getComplemento()
    {
        return  $this->complemento;
    }
    public function getCidade()
    {
        return  $this->cidade;
    }
    public function getCep()
    {
        return  $this->cep;
    }


}


