<?php

/**
 * Funcion encargada de llenar la matriz que representa el tablero
 */
function llenarTablero($tableroStr) {
    // Se convierte el string en una matriz bidimensional de 6x6
    if ($tableroStr != "") {
        $tablero = str_split($tableroStr, 6);
        // Se recorre la matriz para convertir cada string en un array
        for ($i = 0; $i < count($tablero); $i++) {
            $tablero[$i] = str_split($tablero[$i]);
        }
        return $tablero;
    }
    $tablero = array();
    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 6; $j++) {
            if ($i == 0 && $j == 0) {
                $tablero[0][0] = " ";
            }
            elseif ($i == 0){
                $tablero[$i][$j] = $j;
            }
            elseif ($j == 0){
                $tablero[$i][$j] = $i;
            }
            else {
                $tablero[$i][$j] = "L";
            }
        }
    }
    return $tablero;
}

/**
 * Funcion encargada de mostrar el tablero
 */
function mostrarTablero($tablero) {
    echo "<table>";
    for ($i = 0; $i < 6; $i++) {
        echo "<tr class='fila'>";
        for ($j = 0; $j < 6; $j++) {
            echo "<td class='celda'>";
            echo $tablero[$i][$j];
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

/**
 * Funcion encargada de convertir una matriz bidimensional en un string
 */
function tableroToStr($tablero) {
    $tableroStr = "";
    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 6; $j++) {
            $tableroStr .= $tablero[$i][$j];
        }
    }
    return $tableroStr;
}

/**
 * Funcion encargada de gestionar la transaccion
 */
function realizarTransaccion($tableroNuevo, $fila, $columna, $accion) {
    // Se convierte el string en una matriz bidimensional de 6x6 para manupularlo mas facilmente
    $tableroNuevo = llenarTablero($tableroNuevo);
    switch (estadoAsiento($tableroNuevo, $fila, $columna)){
        case "L":
            switch ($accion){
                case "reservar":
                    $tableroNuevo[$fila][$columna] = "R";
                    break;
                case "liberar":
                    mostrarAlerta("No se puede liberar un asiento que no está reservado");
                    break;
                case "comprar":
                    $tableroNuevo[$fila][$columna] = "C";
                    break;
            }
            break;
        case "R":
            switch ($accion){
                case "reservar":
                    mostrarAlerta("No se puede reservar un asiento que ya está reservado");
                    break;
                case "liberar":
                    $tableroNuevo[$fila][$columna] = "L";
                    break;
                case "comprar":
                    $tableroNuevo[$fila][$columna] = "C";
                    break;
            }
            break;
        case "C":
            switch ($accion){
                case "reservar":
                    mostrarAlerta("No se puede reservar un asiento que ya está comprado");
                    break;
                case "liberar":
                    mostrarAlerta("No se puede liberar un asiento que ya está comprado");
                    break;
                case "comprar":
                    mostrarAlerta("No se puede comprar un asiento que ya está comprado");
                    break;
            }
            break;
    }
    return tableroToStr($tableroNuevo);
}

/**
 * Funcion encargada de devolver el estado de un asiento
 */
function estadoAsiento($tablero, $fila, $columna) {
    return $tablero[$fila][$columna];
}

/**
 * Funcion encargada de mostrar una alerta
 */
function mostrarAlerta($mensaje){
    echo "<script>alert('$mensaje');</script>";
}