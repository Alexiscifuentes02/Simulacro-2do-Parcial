<?php
//1. Implementar la jerarquía de herencia que corresponda para implementar las motos Nacionales e Importadas.
/*Para el caso de las motos importadas, se debe almacenar el país desde el que se importa
y el importe correspondiente a los impuestos de importación que la empresa paga por el ingreso al país. */
class MotoImportada extends Moto{
    private $paisOrigen;
    private $impuesto;

    // Metodo constructor de la clase MotoImportada
    public function __construct($codigo,$costo,$anioFab,$descripcion,$porcentaje,$estado,$pais,$impuest){
        parent:: __construct($codigo,$costo,$anioFab,$descripcion,$porcentaje,$estado);
        $this->paisOrigen = $pais;
        $this->impuesto = $impuest;
    }

    // Metodos GET de la clase MotoImportada
    public function getPaisOrigen(){
        return $this->paisOrigen;
    }
    public function getImpuesto(){
        return $this->impuesto;
    }


    // Metodos SET de la clase MotoImportada
    public function setPaisOrigen($pais){
        $this->paisOrigen = $pais;
    }
    public function setImpuesto($impuesto){
        $this->impuesto = $impuesto;
    }

    
    // Metodo que muestra la informacion de la clase MotoImportada
    public function __toString(){
        $cadena = parent::__toString();
        return $cadena. " Pais Origen: " .$this->getPaisOrigen()."\n" .
        " Impuesto: " . $this->getImpuesto()."\n";
    }


    // Metodo que calcula el valor por el cual puede ser vendida una moto
    public function darPrecioVenta(){ 
        $precioVenta = parent::darPrecioVenta();
        $precioVenta = $precioVenta + $this->getImpuesto();
        return $precioVenta;
    }
}