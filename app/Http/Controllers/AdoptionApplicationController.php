<?php
// app/Http/Controllers/AdoptionApplicationController.php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Services\AdoptionServiceInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdoptionApplicationController extends Controller
{
    protected $adoptionService;

    public function __construct(AdoptionServiceInterface $adoptionService )
    {
        $this->adoptionService = $adoptionService;
    }

    public function create(Request $request)
    {
        $this->adoptionService->create([
            'pet_id' => $request->input('pet_id'),
            'user_id' => $request->input('user_id'),
            'user_name' => $request->input('user_name'),
            'email' => $request->input('email'),
            'application_date' => $request->input('application_date'),
            'status' => 'pending',
        ]);
        return redirect()->route('adoptiondetails')->with('success', 'Your adoption application has been submitted.');
    }

    public function index()
    {
        $adoption = $this->adoptionService->all();
        return Inertia::render('adoption/adoptionDetails', [
            'adoption' => $adoption,
        ]);
    }

    public function show($id)
    {
        $adoption = $this->adoptionService->find($id);
        $pets = Pet::find($adoption->pet_id); // Keep pet fetching here

        return Inertia::render('adoption/edit', [
            'adoption' => $adoption,
            'pets' => $pets,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'pet_id' => 'required|integer|exists:pets,id',
            'user_id' => 'required|integer|exists:users,id',
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'application_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $adoption = $this->adoptionService->update($id, $validatedData);

        return redirect()->route('adoptiondetails', $adoption->pet_id)->with('message', 'Adoption application updated successfully!');
    }
}
