<?php 

namespace App\Repository\Interfaces;

interface UpdaterInterface
{
    public function update($id, array $data);
}