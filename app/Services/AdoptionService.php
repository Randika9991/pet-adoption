<?php

// app/Services/AdoptionService.php

namespace App\Services;

use App\Mail\sendmail;
use App\Models\AdoptionApplication;
use App\Repositories\AdoptionRepositoryInterface;
use Illuminate\Support\Facades\Mail;

class AdoptionService implements AdoptionServiceInterface
{
    protected $adoptionRepository;

    public function __construct(AdoptionRepositoryInterface $adoptionRepository)
    {
        $this->adoptionRepository = $adoptionRepository;
    }

    public function create(array $data)
    {
        return $this->adoptionRepository->create($data);
    }

    public function update($id, array $data)
    {
        $adoption = $this->adoptionRepository->find($id);
        $adoption->update($data);

        // Send email after updating
        Mail::to($adoption->email)->send(new sendmail($adoption));
        return $adoption;
    }

    public function find($id)
    {
        return $this->adoptionRepository->find($id);
    }

    public function all()
    {
        return $this->adoptionRepository->all();
    }
}
