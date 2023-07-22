<?php

function toRootPath($path) {
    // Supprime les slash en début de chaîne
    $path = ltrim($path, '/');
    
    // Ajoute le slash de début pour faire un chemin absolu
    $path = '/' . $path;
    
    return $path;
}
