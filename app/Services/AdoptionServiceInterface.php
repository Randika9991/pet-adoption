<?php

// app/Services/AdoptionServiceInterface.php

namespace App\Services;

interface AdoptionServiceInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function find($id);
    public function all();
}
