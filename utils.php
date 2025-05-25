<?php
function imagenPorNombre(string $nombre): string {
    $nombre = strtolower($nombre);
    return match (true) {
        str_contains($nombre, 'aceite') => 'aceite.png',
        str_contains($nombre, 'leche')  => 'leche.png',
        str_contains($nombre, 'pan')    => 'pan.png',
        str_contains($nombre, 'arroz')  => 'arroz.png',
        default                         => 'default.png'
    };
}