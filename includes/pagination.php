<?php

class Pagination {

    public $currentPage;
    public $perPage;
    public $totalCount;


    public function __construct($page = 1, $perPage = 20, $totalCount = 0 ){
        $this->currentPage = (int) $page;
        $this->perPage = (int) $perPage;
        $this->totalCount = (int) $totalCount;       
    }

    public function offset(){
        // Assumign 20 items per page:
        // Page 1 has an offset 0  (1-1) * 20
        // Page 2 has and offset 1 (2-1) * 20
        // In other words, page 2 starts  with item 21
        return ($this->currentPage - 1) * $this->perPage;
     }

    public function totalPages(){
        return ceil($this->totalCount / $this->perPage);
    }

    public function previousPage(){
        return $this->currentPage - 1;
    }

    public function nextPage(){
        return $this->currentPage + 1;
    }

    public function hasPreviousPage(){
        return $this->previousPage() >= 1 ? true : false;
    }

    public function hasNextPage(){
        return $this->nextPage() <= $this->totalPages() ? true : false;
    }
}