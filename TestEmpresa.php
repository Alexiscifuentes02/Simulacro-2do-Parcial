<?php 
include_once 'Cliente.php';
include_once 'Moto.php'; 
include_once 'Venta.php'; 
include_once 'Empresa.php';
include_once 'MotoNacional.php';
include_once 'MotoImportada.php';


//1)
$objCliente1 = new Cliente("Marcelo","Gallardo",false,"dni",90784623);
$objCliente2 = new Cliente("Enzo","Francescoli",false,"dni",78821624);

//2)
$objMoto1 = new MotoNacional(11,2230000,2022,"Benelli Imperiale 400",85,true,10);
$objMoto2 = new MotoNacional(12,584000,2021,"Zanella Zr 150 Ohc",70,true,10);
$objMoto3 = new MotoNacional(13,999900,2023,"Zanella Patagonian Eagle 250",55,false,0);
$objMoto4 = new MotoImportada(14,12499900,2020,"Pitbike Enduro Motocross Apollo Aiii 190cc Plr",100,true,"Francia",6244400);


//3)
$objEmpresa = new Empresa("Alta Gama","Av Argenetina 123",[$objCliente1,$objCliente2],[$objMoto1,$objMoto2,$objMoto3],[]);

//4)
$importe =$objEmpresa->registrarVenta([11,12,13,14],$objCliente2);
echo "Punto 4),el importe es $".$importe."\n";

//5)
$importe2 = $objEmpresa->registrarVenta([13,14],$objCliente2);
echo "Punto 5), el importe es $".$importe2."\n";

//6)
$importe3 = $objEmpresa->registrarVenta([14,2],$objCliente2);
echo "Punto 6), el importe es $".$importe3."\n";

//7) 
$ventasMotosImportadas = $objEmpresa->informarVentasImportadas();
echo "Punto 7). " . mostrarVentas($ventasMotosImportadas);

//8)
echo "8. La suma de ventas nacionales es: $" . $objEmpresa->informarSumaVentasNacionales() . "\n";

//9)
echo $objEmpresa->__toString();

// Metodo que  recorre y  muestra las ventas
function mostrarVentas($ventas){
    if($ventas == null){
        $mensaje = "La venta es nula\n";
    }else{
        $mensaje = "Las ventas del cliente:\n";
        for($i=0;$i<count($ventas);$i++){
            $mensaje= $mensaje.$ventas[$i]."\n";
        }
    }
    return $mensaje;
}




