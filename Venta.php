<?php 
/*En la clase Venta:
1. Implementar el método retornarTotalVentaNacional() que retorna la sumatoria del precio venta de 
cada una de las motos Nacionales vinculadas a la venta.
2. Implementar el método retornarMotosImportadas() que retorna una colección de motos importadas 
vinculadas a la venta. Si la venta solo se corresponde con motos Nacionales la colección retornada 
debe ser vacía.
*/

class Venta{
    private $numeroVenta;
    private $fechaVenta;
    private $objCliente;
    private $arrayMotos;
    private $precioFinal;

    // Metodo constructor de la clase Venta
    public function __construct($numVenta,$fecha, Cliente $cliente, $colMotos,$precio){
        $this->numeroVenta = $numVenta;
        $this->fechaVenta = $fecha;
        $this->objCliente = $cliente;
        $this->arrayMotos = $colMotos;
        $this->precioFinal = $precio;
    }

    // Metodos GET de la clase Venta
    public function getNumeroVenta(){
        return $this->numeroVenta;
    }

    public function getFechaVenta(){
        return $this->fechaVenta;
    }

    public function getCliente(){
        return $this->objCliente;
    }

    public function getMotos(){
        return $this->arrayMotos;
    }

    public function getPrecioFinal(){
        return $this->precioFinal;
    }



    // Metodos SET de la clase Venta 
    public function setNumeroVenta($numVenta){
        $this->numeroVenta = $numVenta;
    }

    public function setFechaVenta($fecha){
        $this->fechaVenta = $fecha;
    }

    public function setCliente($cliente){
        $this->objCliente = $cliente;
    }

    public function setMotos($colMotos){
        $this->arrayMotos = $colMotos;
    }

    public function setPrecioFinal($precio){
        $this->precioFinal = $precio;
    }


    // Metodo que muestra la informacion de la clase Venta
    public function __toString(){
        return "Numero:\n".$this->getNumeroVenta()."\n".
                "Fecha:\n".$this->mostrarFecha()."\n".
                "Cliente:\n".$this->getCliente()."\n".
                "Motos:\n".$this->mostrarMotos()."\n".
                "Precio final: $\n".$this->getPrecioFinal()."\n";
    }

    // Metodo que muestra las motos de la coleccion
    public function mostrarMotos(){
        $arregloMotos = $this->getMotos();
        $cadena = "";
        $numMoto = 0;
        for($i=0;$i<count($arregloMotos);$i++){
            $numMoto++;
            $moto = $arregloMotos[$i];
            $cadena = $cadena. "Moto: ".$numMoto."\n".$moto."\n";
        }
        return $cadena;
    }

    // Metodo que retorna la fecha
    public function mostrarFecha(){
        $fecha = $this->getFechaVenta();
        return $fecha["Dia"]. "/" .$fecha["Mes"]. "/" .$fecha["Anio"]."\n";
    }

    // Metodo que recibe un objeto moto y lo incorpora a la colección de motos de la venta
    public function incorporarMoto($objMoto){
        $arregloMotos =  $this->getMotos();
        $valor = $objMoto->darPrecioVenta();
        $estado = $objMoto->mostrarEstado();
        if($valor != -1 && $estado == "Si"){
           $arregloMotos[] = $objMoto;
           $this->setPrecioFinal($valor + $this->getPrecioFinal());
           $this->setMotos($arregloMotos);
        }
    }


    // Metodo que retorna la sumatoria del precio venta de cada una de las motos Nacionales vinculadas a la venta
    public function retornarTotalVentaNacional(){
        $colMotos = $this->getMotos();
        $cantMotos = count($this->getMotos());
        $sumatoriaPrecio = 0;
        for($i=0;$i<$cantMotos;$i++){
            $unaMoto = $colMotos[$i];
            if($unaMoto instanceof MotoNacional){
                $precioVenta = $unaMoto->darPrecioVenta();
                $sumatoriaPrecio = $sumatoriaPrecio + $precioVenta;
            }
        }
        return $sumatoriaPrecio;
    }


    // Metodo que retorna una colección de motos importadas vinculadas a la venta
    public function retornarMotosImportadas(){
        $colMotos = $this->getMotos();
        $cantMotos = count($this->getMotos());
        $colMotosImportadas = array();
        for($i=0;$i<$cantMotos;$i++){
            $unaMoto = $colMotos[$i];
            if($unaMoto instanceof MotoImportada){
                array_push($colMotosImportadas,$unaMoto);
            }
        }
        return $colMotosImportadas;
    }


}