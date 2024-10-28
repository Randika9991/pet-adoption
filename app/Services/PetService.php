<?php

namespace App\Services;

use App\Repositories\PetRepositoryInterface;

class PetService implements PetServiceInterface
{
    protected $petRepository;

    public function __construct(PetRepositoryInterface $petRepository)
    {
        $this->petRepository = $petRepository;
    }

    public function create(array $data)
    {
        // Check if additional business rules need to be applied (e.g., verify the user has permissions)
        // Prepare the data, like handling the image upload

        if (isset($data['image'])) {
            // Assume the image is already validated
            $imagePath = $data['image']->store('images', 'public');
            $data['image'] = $imagePath;
        }

        // Use the repository to save the pet in the database
        return $this->petRepository->create($data);
    }


    public function update($id, array $data)
    {
        return $this->petRepository->update($id, $data);
    }

    public function find($id)
    {
        return $this->petRepository->find($id);
    }

    public function all()
    {
        return $this->petRepository->all();
    }

    public function delete($id)
    {
        return $this->petRepository->delete($id);
    }
}

