<?php

namespace App\Http\Controllers;

use App\Events\PetAdded;
use App\Services\PetServiceInterface;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    protected $petService;

    public function __construct(PetServiceInterface $petService)
    {
        $this->petService = $petService;
    }

    public function showForm($id)
    {
        $pets = $this->petService->find($id); // Keep pet fetching here
        $user = auth()->user();
        return Inertia::render('adoption/index', [
            'pets' => $pets,
            'user' => $user,
        ]);
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'petname' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'story' => 'nullable|string',
            'is_adopted' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        $pets = $this->petService->create($validatedData);

        event(new PetAdded($pets));

        return redirect()->route('pet')->with('message', 'Pet added successfully!');
    }

    public function index(Request $request): Response
    {
        $pets = $this->petService->all();
        return Inertia::render('Pet/index', ['pets' => $pets]);
    }

    public function show($id)
    {
        $pet = $this->petService->find($id);
        $user = Auth()->user();

        if (!$pet) {
            abort(404, 'Pet not found');
        }

        return Inertia::render('Pet/show', [
            'pet' => $pet,
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        $pet = $this->petService->find($id);
        $user = Auth()->user();

        if (!$pet) {
            abort(404, 'Pet not found');
        }

        return Inertia::render('Pet/edit', [
            'pet' => $pet,
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'petname' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'story' => 'nullable|string',
            'is_adopted' => 'required|boolean',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $updateStatus = $this->petService->update($id, $validatedData);

        if ($updateStatus) {
            return redirect()->route('pets.show', ['id' => $id])->with('message', 'Pet updated successfully!');
        } else {
            return redirect()->route('pets.show', ['id' => $id])->with('error', 'Failed to update pet!');
        }
    }

    public function destroy($id)
    {
        $deleted = $this->petService->delete($id);

        if ($deleted) {
            return redirect()->route('pet')->with('message', 'Pet deleted successfully!');
        } else {
            return redirect()->route('pet')->with('error', 'Failed to delete pet.');
        }
    }
}

