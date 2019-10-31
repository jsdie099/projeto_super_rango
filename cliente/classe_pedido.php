<?php
class Pedido
{
    protected $valor;
    protected $quantidade;
    protected $num;



    public function setValor($v)
    {
        $this->valor = $v;
    }
    public function setQuantidade($q)
    {
        $this->quantidade=$q;
    }
    public function setNum($n)
    {
        $this->num=$n;
    }
    public function getNum()
    {
        return $this->num;
    }
    public function getValor()
    {
        return $this->valor;
    }
    public function getQuantidade()
    {
        return $this->quantidade;
    }

}
?>
