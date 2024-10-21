<?php
namespace App\Repositories;

use App\Models\Pet;

class PetRepository implements PetRepositoryInterface
{
    public function all($perPage = 3)
    {
        return Pet::latest()->paginate($perPage);
    }

    public function find($id)
    {
        return Pet::findOrFail($id);
    }

    public function create(array $data)
    {
        return Pet::create($data);
    }

    public function update($id, array $data)
    {
        $pet = Pet::findOrFail($id);
        $pet->update($data);
        return $pet;
    }

    public function delete($id)
    {
        return Pet::destroy($id);
    }
}
