<?php
namespace App\Repositories;

use App\Models\AdoptionApplication;
use App\Models\Pet;

class AdoptionRepository implements AdoptionRepositoryInterface
{
    public function all($perPage = 3)
    {
        return AdoptionApplication::latest()->paginate($perPage);
    }

    public function find($id)
    {
        return AdoptionApplication::findOrFail($id);
    }

    public function create(array $data)
    {
        return AdoptionApplication::create($data);
    }

    public function update($id, array $data)
    {
        $pet = AdoptionApplication::findOrFail($id);
        $pet->update($data);
        return $pet;
    }

    public function delete($id)
    {
        return AdoptionApplication::destroy($id);
    }

    public function findByUserId($userId,$perPage = 3)
    {
        return AdoptionApplication::where('user_id', $userId)->latest()->paginate($perPage);
    }
}
