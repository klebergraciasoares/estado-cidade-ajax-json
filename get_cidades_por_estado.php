<?php
header('Content-Type: application/json');
require_once 'LocalizacaoBrasil.php';

$estadoId = $_GET['estado_id'] ?? null;

if ($estadoId) {
    $loc = new LocalizacaoBrasil();
    $cidades = $loc->getCidadesPorEstado($estadoId);
    echo json_encode(array_values($cidades)); // remove as chaves
} else {
    echo json_encode([]);
}
