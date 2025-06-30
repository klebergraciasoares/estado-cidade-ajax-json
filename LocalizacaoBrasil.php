<?php

class LocalizacaoBrasil {
    private $jsonData;

    public function __construct($jsonPath = 'dados_estados_cidades.json') {
        $conteudo = file_get_contents($jsonPath);
        $this->jsonData = json_decode($conteudo, true);
    }

    public function getEstados() {
        return $this->jsonData['states'] ?? [];
    }

    public function getCidadesPorEstado($stateId) {
        $cidades = $this->jsonData['cities'] ?? [];
        return array_filter($cidades, function ($cidade) use ($stateId) {
            return $cidade['state_id'] == $stateId;
        });
    }
}