<?php

/* -------- ENTREGA TP Repaso IPOO 2021 --------
 * 
 * Dado una estructura de arreglos asociativos, donde cada arreglo se corresponde 
 * con una variedad de vino (malbec, cabernet Sauvignon, Merlot) y se almacena la siguiente información: 
 * variedad, cantidad de botellas, año de producción, precio por unidad; 
 * retornar un arreglo que por variedad retorne la cantidad de botellas y el precio promedio.
 * 
 * 1. Implementar una función que reciba un arreglo con las características  mencionadas y retorne  un 
 *      arreglo que por variedad de vino guarde la cantidad total de botellas y el precio promedio.
 * 2. Implementar una función main() que cree un arreglo con las características mencionadas, invoque 
 *      a la función implementada en 1 y visualice su resultado
 * 3. Subir a su cuenta GitHub la resolución del Trabajo Practico de Repaso.
 * 
 * 
 * Alumno: Estrada, Emiliano Ángel
 * Legajo: FAI-2615
 *----------------------------------------------*/

function main() {
    
    // -- Definción y carga de Arreglos (se tomaron distintas cantidades de casos por variedad)
    $malbec = array("variedad" => "Malbec", "cantBotellas" => array(1, 3, 3), "anioProd" => 2000, "precioUnitario" => array(110.25, 111.10, 109)); 
    $cabernetSauvignon = array("variedad" => "Cabernet Sauvignon", "cantBotellas" => array(5, 2), "anioProd" => 2001, "precioUnitario" => array(202.15, 205));
    $merlot = array("variedad" => "Merlot", "cantBotellas" => array(6, 1, 2, 2), "anioProd" => 2004, "precioUnitario" => array(100.50, 103, 102.99, 100.25));
    
    $vinos = array($malbec, $cabernetSauvignon, $merlot);
    
    
    // -- Llamada a la función que calcula los promedios
    $resultado = precioPromedio($vinos);
    
    // -- Muestra de resultados
    echo "Los precios promedio por variedad son: \n\n";
    for ($i = 0; $i < count($resultado); $i++) {
        printf("  %s => $ %.2f \n", $resultado[$i]["variedad"],$resultado[$i]["precioPromedio"]);
    }
}


/** Devuelve el precio promedio por variedad de vino
 * 
 * @param array $datosVinos (contiene la información de variedades, botellas, precio unitario, etc.)
 * @return array (contiene variedad y precio promedio)
 */
function precioPromedio($datosVinos) {
    
    $retorno = array();     //Array mixto a devolver
    $sumaParcial = 0.00;    //Tipo float, acumula los productos parciales para el promedio
    $totalBotellas = 0;     //Tipo int, acumula la cantidad de botellas
    $j = 0;                 //Tipo int, contador interno
    
    foreach ($datosVinos as $value) {                           //Recorre todas las variedades
        foreach ($value as $key => $valor) {                    //Recorre una variedad 
            if ($key == "variedad") {               
                $retorno[$j][$key] = $valor;                    //Variedad a la que calculará el promedio
            }
            if ($key == "cantBotellas") {           
                
                for ($i = 0; $i < count($valor); $i++) {        //Calculos auxiliares de promedio
                    $sumaParcial += $valor[$i] * $value["precioUnitario"][$i];
                    $totalBotellas += $valor[$i];
                }
                
                if ($totalBotellas == 0) {                      //Verifica cant. de botellas para no dividir por cero
                    $promedio = 0;
                }else {
                    $promedio = $sumaParcial/$totalBotellas;    //Cálculo promedio
                }
                
                $retorno[$j]["precioPromedio"] = $promedio;
                $sumaParcial = 0;
                $totalBotellas = 0;
                $j++;
            }
        }
    }
    return $retorno;
}

?>