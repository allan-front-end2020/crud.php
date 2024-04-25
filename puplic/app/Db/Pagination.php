<?php

namespace App\Db;

class Pagination {

  private $limit;

  private $resultado;

  private $pages;

  private $currentPage;


  public function __construct($resultado, $currentPage = 1, $limit = 10) {
    $this->resultado = $resultado;
    $this->limit = $limit;
    $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
    $this->calculate();
  }

  private function calculate() {
    $this->pages = $this->resultado > 0 ? ceil($this->resultado / $this->limit) : 1;
    $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
  }

  public function getLimit() {
    $offset = ($this->limit * ($this->currentPage - 1));
    return $offset . ',' . $this->limit;
  }

  public function getPages() {
    if ($this->pages == 1) return [];
    $paginas = [];
    for ($i = 1; $i <= $this->pages; $i++) {
      $paginas[] = [
        'pagina' => $i,
        'atual' => $i == $this->currentPage
      ];
    }
    return $paginas;
  }
}
