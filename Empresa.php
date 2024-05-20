<?php 
/* En la clase Empresa:
1. Implementar el método informarSumaVentasNacionales() que recorre la colección de ventas realizadas 
por la empresa y retorna el importe total de ventas Nacionales realizadas por la empresa.
2. Implementar el método informarVentasImportadas() que recorre la colección de ventas realizadas por 
la empresa y retorna una colección de ventas de motos importadas. Si en la venta al menos una de las 
motos es importada la venta debe ser informada.
(*IMPORTANTE: invocar a los métodos implementados en la clase venta cuando crea necesario)*/

class Empresa{
    private $denominacionEmpresa;
    private $direccionEmpresa;
    private $arrayClientes;
    private $arrayMotos;
    private $arrayVentas;

    // Metodo constructor dela clase Empresa
    public function __construct($denominacion,$direccion,$colClientes,$colMotos,$colVentas){
        $this->denominacionEmpresa = $denominacion;
        $this->direccionEmpresa = $direccion;
        $this->arrayClientes = $colClientes;
        $this->arrayMotos = $colMotos; 
        $this->arrayVentas = $colVentas;
    }

    // Metodos GET de la clase Empresa
    public function getDenominacionEmpresa(){
        return $this->denominacionEmpresa;
    }
        
    public function getDireccionEmpresa(){
        return $this->direccionEmpresa;
    }

    public function getClientes(){
        return $this->arrayClientes;
    }

    public function getMotos(){
        return $this->arrayMotos;
    }

    public function getVentas(){
        return $this->arrayVentas;
    }


    // Metodos SET de la clase Empresa
    public function setDenominacionesEmpresa($denominacion){
        $this->denominacionEmpresa = $denominacion;
    }

    public function setDireccionesEmpresa($direccion){
        $this->direccionEmpresa = $direccion;
    }

    public function setClientes($colClientes){
        $this->arrayClientes = $colClientes;
    }

    public function setMotos($colMotos){
        $this->arrayMotos = $colMotos;
    }

    public function setVentas($colVentas){
        $this->arrayVentas = $colVentas;
    }

    // Metodo que muestra la informacion de la clase Empresa
    public function __toString(){
        return "Denominacion de la empresa:\n".$this->getDenominacionEmpresa()."\n".
                "Direccion de la empresa:\n".$this->getDireccionEmpresa()."\n".
                "Clientes:\n".$this->mostrarClientes()."\n".
                "Motos:\n".$this->mostrarMotos()."\n".
                "Ventas:\n".$this->mostrarVentas()."\n";
    }
    

    // Metodo que muestra los clientes de la coleccion
    public function mostrarClientes(){
        $arregloClientes = $this->getClientes();
        $cadena = "";
        $numCliente = 0;
        for($i=0;$i<count($arregloClientes);$i++){
            $numCliente++;
            $cliente = $arregloClientes[$i];
            $cadena = $cadena. "Cliente:". $numCliente."\n".$cliente."\n";  
        }
        return $cadena;
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

        
    // Metodo que muestra las ventas de la coleccion
    public function mostrarVentas(){
        $arregloVentas = $this->getVentas();
        $cadena = "";
        $numVenta = 0;
        for($i=0;$i<count($arregloVentas);$i++){
            $numVenta++;
            $venta = $arregloVentas[$i];
            $cadena = $cadena. "Venta:". $numVenta."\n".$venta."\n";  
        }
        return $cadena;
    }


    // Metodo que retorna una moto cuyo codigo coincida con el del parametro
    public function retornarMoto($codigo){
        $arregloMotos = $this->getMotos();
        $i= 0;
        $objMoto = null;
        while($i<count($arregloMotos) && $objMoto == null){
            if($arregloMotos[$i]->getCodigo() == $codigo){
                $objMoto = $arregloMotos[$i];
            }
        }
        return $objMoto;
    }

    /**6. Implementar el método registrarVenta($colCodigosMoto, $objCliente) método que recibe por
    parámetro una colección de códigos de motos, la cual es recorrida, y por cada elemento de la colección
    se busca el objeto moto correspondiente al código y se incorpora a la colección de motos de la 
    instancia Venta que debe ser creada. Recordar que no todos los clientes ni todas las motos, están 
    disponibles para registrar una venta en un momento determinado.
    El método debe setear los variables instancias de venta que corresponda y retornar el importe final 
    de la venta. */
    public function registrarVenta($colCodigosMoto,$objCliente){
        $importe = 0;
        $colMotos = $this->getMotos();
        for($i=0;$i<count($colCodigosMoto);$i++){
            $unCodigo = $colCodigosMoto[$i];
            for($j=0;$j<count($colMotos);$j++){
                $unaMoto = $colMotos[$j];
                if($unCodigo == $unaMoto->getCodigoMoto()){
                    if($objCliente->mostrarBaja() == "No"){
                        $n = 1;
                        $fecha = ["Dia"=>1,"Mes"=>8,"Anio"=>2000];
                        $venta = new Venta($n,$fecha,$objCliente,[],20000);
                        $venta->incorporarMoto($unaMoto);
                        $ventas[] = $venta;
                        $this->setVentas($ventas);
                        $clientes[]= $objCliente;
                        $this->setClientes($clientes);
                        $importe = $venta->getPrecioFinal();
                    }
                }
            }
        }
        return $importe;
    }
    

    /* Implementar el método retornarVentasXCliente($tipo,$numDoc) que recibe por parámetro el tipo y
     número de documento de un Cliente y retorna una colección con las ventas realizadas al cliente.*/
    public function retornarVentasXCliente($tipo,$numDoc){
        $colVentas = $this->getVentas();
        $ventasCliente = null;
        for($i=0;$i<count($colVentas);$i++){
            $unaVenta = $colVentas[$i];
            if($unaVenta->getCliente()->getTipoDocumento() == $tipo && $unaVenta->getCliente()->getDocumentoCliente() == $numDoc){
                $ventasCliente[] = $unaVenta;
            }
        }
            
        return $ventasCliente;
    }


    //Metodo que recorre la colección de ventas realizadas y retorna el importe total de ventas Nacionales
    public function informarSumaVentasNacionales(){
        $colVentas = $this->getVentas();
        $importeTotal = 0;
        for($i=0;$i<count($colVentas);$i++){
            $unaVenta = $colVentas[$i];
            $totalVenta = $unaVenta->retornarTotalVentaNacional();
            $importeTotal = $importeTotal + $totalVenta;
        }
        return $importeTotal;
    } 



    // Metodo que recorre la colección de ventas realizadas y retorna la coleccion de motos importadas 
    public function informarVentasImportadas(){
        $colVentas = $this->getVentas();
        $colVentasMotosImportadas = array();

        for($i=0;$i<count($colVentas);$i++){
            $unaVenta = $colVentas[$i];
            $ventaMotosImportadas = $unaVenta->retornarMotosImportadas();
            if(!empty($ventaMotosImportadas)){
                array_push($colVentasMotosImportadas,$ventaMotosImportadas);
            }
        }
        return $colVentasMotosImportadas;
    }
}
