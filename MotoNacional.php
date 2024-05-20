<?php
//1. Implementar la jerarquía de herencia que corresponda para implementar las motos Nacionales e Importadas.
/*Con el objetivo de incentivar el consumo de productos Nacionales, se desea almacenar un porcentaje de descuento en las motos Nacionales que
será aplicado al momento de la venta (por defecto el valor del descuento es del 15%). */
class MotoNacional extends Moto{
    private $porcentajeDescuento;

    // Metodo constructor de la clase MotoNacional
    public function __construct($codigo,$costo,$anioFab,$descripcion,$porcentaje,$estado,$porcDescuento){
        parent::__construct($codigo,$costo,$anioFab,$descripcion,$porcentaje,$estado);
        $this->porcentajeDescuento = $porcDescuento;
    }


    // Metodos GET de la clase MotoNacional
    public function getPorcDescuento(){
        return $this->porcentajeDescuento;
    }


    // Metodos SET de la clase MotoNacional
    public function setPorcDescuento($descuento){
        $this->porcentajeDescuento = $descuento;
    }

    // Metodo que muestra la informacion de la clase MotoImportada
    public function __toString(){
        $cadena = parent::__toString();
        return $cadena . " Porc Descuento: " . $this->getPorcDescuento() ."\n";
    }


    // Metodo que calcula el valor por el cual puede ser vendida una moto
    public function darPrecioVenta(){ 
        $precioVenta = parent::darPrecioVenta();
        if($this->getPorcDescuento() == 0){
            $this->setPorcDescuento(15);
        }
        $precioVenta = $precioVenta - ($precioVenta * $this->getPorcDescuento() / 100);
        return $precioVenta;
    }
}