<?php

namespace App\Http\Controllers;

use App\Mail\sendmail;
use App\Models\AdoptionApplication;
use App\Models\Pet;
use App\Repositories\AdoptionRepositoryInterface;
use App\Repositories\PetRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Inertia\Inertia;

// Add this at the top of your controller if not already imported

class AdoptionApplicationController extends Controller
{
    protected $adoptionRepository;
    protected $petRepository;

    public function __construct(AdoptionRepositoryInterface $adoptionRepository,PetRepositoryInterface $petRepository)
    {
        $this->adoptionRepository = $adoptionRepository;
        $this->petRepository = $petRepository;
    }

    public function showForm($id)
    {
        $pets = $this->petRepository->find($id);
        $user = auth()->user();
        return Inertia::render('adoption/index', [
            'pets' => $pets, // Pass pets data to the Vue component
            'user' => $user,
        ]);
    }

    public function create(Request $request)
    {
//        dd($request);
        $this->adoptionRepository->create([
            'pet_id' => $request->input('pet_id'),
            'user_id' => $request->input('user_id'),
            'user_name' => $request->input('user_name'),
            'email' => $request->input('email'),
            'application_date' => $request->input('application_date'),
            'status' => 'pending',
        ]);
        return redirect()->route('pet')->with('success', 'Your adoption application has been submitted.');
    }



    public function index()
    {
        $adoption = $this->adoptionRepository->all(); // Adjust the number for pagination as needed
        return Inertia::render('adoption/adoptionDetails', [
            'adoption' => $adoption,
        ]);
    }

    public function show($id)
    {
//      dd($id);
        $adoption =  $this->adoptionRepository->find($id);
        $pets = $this->petRepository->find($adoption->pet_id);

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
            'status' => 'required|string' // Ensure that status is also validated
        ]);

        logger($validatedData);

        $adoption = AdoptionApplication::findOrFail($id);

        if (!$adoption) {
            return redirect()->route('pets')->with('error', 'Adoption application not found!');
        }

        $adoption->update([
            'pet_id' => $validatedData['pet_id'],
            'user_id' => $validatedData['user_id'],
            'user_name' => $validatedData['user_name'],
            'email' => $validatedData['email'],
            'application_date' => $validatedData['application_date'],
            'status' => $validatedData['status'],
        ]);

        $save = $adoption->save();


        if ($save) {
            try {
                $email = Mail::to($adoption->email)->send(new sendmail($adoption));
                if ($email) {
                    return redirect()->route('adoptionDetails', $adoption->pet_id)->with('message', 'Adoption application updated successfully!');
                }
            } catch (\Exception $e) {
                dd($e);
            }
        }else{
            echo "error";
        }
    }
}

