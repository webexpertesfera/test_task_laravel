<?php 

namespace App\Repository;

interface RetrieverInterface{
    public function retrieve();
    public function retrievePaginated();
    public function getFilterableColumns();
}