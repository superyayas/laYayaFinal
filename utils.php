<?php
function imagenPorNombreCategoria(string $nombreCategoria): string {
    $nombre = strtolower(trim($nombreCategoria));

    return match ($nombre) {
        'Lácteos'   => 'leche.png',
        'Carnes'  => 'pechugaPollo.png',
        'Bebidad'   => 'cocaCOla.png',
        'Harinas'     => 'pan.png',
        'Pescados'     => 'pescado.png',
        default   => 'default.png',
    };
}