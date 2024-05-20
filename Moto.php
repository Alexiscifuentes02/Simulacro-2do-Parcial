<?php 
/**1. Implementar la jerarquía de herencia que corresponda para implementar las motos Nacionales e Importadas.
2. Incorporar los atributos que se requieren para el nuevo requerimiento de la empresa.
3. Redefinir el método toString para que retorne la información de los atributos de la clase.
4. Redefinir el método darPrecioVenta para que en el caso de las motos nacionales aplique el porcentaje 
de descuento sobre el valor calculado inicialmente. Para el caso de las motos importadas, al valor 
calculado se debe sumar el impuesto que pagó la empresa por su importación. A continuación se describe 
el método darPrecioVenta con el objetivo de tener presente su implementación y realizar las modificaciones 
que crea necesarias para dar soporte al nuevo requerimiento.
===================================================================================
.: Recordar :. el método darPrecioVenta inicialmente calculaba el valor por el cual puede ser vendida una moto. Si
la moto no se encuentra disponible para la venta retorna un valor < 0. Si la moto está disponible para la venta, el
método realiza el siguiente cálculo:
$_venta = $_compra + $_compra * (anio * por_inc_anual)
donde $_compra: es el costo de la moto.
anio: cantidad de años transcurridos desde que se fabricó la moto.
por_inc_anual: porcentaje de incremento anual de la moto.
=====================================================*/

class Moto{
    private $codigoMoto;
    private $costoMoto;
    private $anioFabricacion;
    private $descripcionMoto;
    private $porcentajeIncremento;
    private $activa;

    // Metodo constructor de la clase Moto
    public function __construct($codigo,$costo,$anio,$descripcion,$porcentaje,$act){
        $this->codigoMoto = $codigo;
        $this->costoMoto = $costo;
        $this->anioFabricacion = $anio;
        $this->descripcionMoto = $descripcion;
        $this->porcentajeIncremento = $porcentaje;
        $this->activa = $act;
    }

    // Metodos GET de la clase Moto
    public function getCodigoMoto(){
        return $this->codigoMoto;
    }

    public function getCostoMoto(){
        return $this->costoMoto;
    }

    public function getAnioFabricacion(){
        return $this->anioFabricacion;
    }

    public function getDescripcionMoto(){
        return $this->descripcionMoto;
    }

    public function getPorcentaje(){
        return $this->porcentajeIncremento;
    }

    public function getActiva(){
        return $this->activa;
    }


    // Metodos SET de la clase Moto
    public function setCodigoMoto($codigo){
        $this->codigoMoto = $codigo;
    }

    public function setCostoMoto($costo){
        $this->costoMoto = $costo;
    }

    public function setAnioFabricacion($anio){
        $this->anioFabricacion = $anio;
    }

    public function setDescripcionMoto($descripcion){
        $this->descripcionMoto = $descripcion;
    }

    public function setPorcentaje($porcentaje){
        $this->porcentajeIncremento = $porcentaje;
    }

    public function setActiva($act){
        $this->activa = $act;
    }

    // Metodo que muestra la informacion de la clase Moto
    public function __toString(){
        return "Codigo: ".$this->getCodigoMoto()."\n".
                "Costo: ".$this->getCostoMoto()."\n".
                "Anio de fabricacion: ".$this->getAnioFabricacion()."\n".
                "Descripcion:\n".$this->getDescripcionMoto()."\n".
                "Porcentaje de incremento anual: ".$this->getPorcentaje()."%\n".
                "Activa?: ".$this->mostrarEstado()."\n";
    }


    // Metodo que retorna un mensaje de acuerdo a si la moto esta disponible para la venta
    public function mostrarEstado(){
        $estadoMoto = $this->getActiva();
        if($estadoMoto){
            $mensaje = "Si";
        }else{
            $mensaje = "No";
        }
        return $mensaje;
    }


    // Metodo que calcula el valor por el cual puede ser vendida una moto
    public function darPrecioVenta(){
        $costo = $this->getCostoMoto(); 
        $anio = getdate()["year"] - $this->getAnioFabricacion();
        $porcIncremento = $this->getPorcentaje();
        $disponible = $this->getActiva();
        if($disponible){
            $venta = $costo + $costo * ($anio * $porcIncremento);
        }else{
            $venta = -1;
        }
        return $venta;   
    }

}