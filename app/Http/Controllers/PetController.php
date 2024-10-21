<?php

namespace App\Http\Controllers;

use App\Repositories\PetRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Response;
use Inertia\Inertia;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    protected $petRepository;

    public function __construct(PetRepositoryInterface $petRepository)
    {

        $this->petRepository = $petRepository;
    }

    public function save(Request $request)
    {
        // Validate part pet
        $validatedData = $request->validate([
            'petname' => 'required|string|max:255',
            'petcategory' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'story' => 'nullable|string',
            'is_adopted' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/', // Phone number validation
            // Address as string instead of image
        ]);

        // Prepare data for repository
        $data = [
            'petname' => $validatedData['petname'],
            'category' => $validatedData['petcategory'],
            'breed' => $validatedData['breed'],
            'age' => $validatedData['age'],
            'gender' => $validatedData['gender'],
            'story' => $validatedData['story'],
            'is_adopted' => $validatedData['is_adopted'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'user_id' => auth()->user()->id,
        ];

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath; // Store the path in the array
        }

        // Use the repository to save the pet
        $this->petRepository->create($data);

        // Redirect
        return redirect()->route('pet')->with('message', 'Pet added successfully!');
    }

    //work index service repo
    public function index(Request $request) : Response
    {
        $pets = $this->petRepository->all(); // Adjust the number for pagination as needed
        return Inertia::render('Pet/index', [
            'pets' => $pets, // Pass pets data to the Vue component
        ]);
    }

    //work show service repo
    public function show($id)
    {
        // Retrieve the pet from the repository
        $pet = $this->petRepository->find($id);

        // Ensure the user is authenticated and get their details
        $user = Auth()->user();

        // Check if pet and user data are available
        if (!$pet) {
            abort(404, 'Pet not found');
        }

        // Return the view with the pet and user data
        return Inertia::render('Pet/show', [
            'pet' => $pet,
            'user' => $user,
        ]);
    }

    //work show service repo
    public function edit($id)
    {
//        dd($id);
//        $pet = $this->petRepository->find($id); // Fetch the pet using the repository
//        return view('pets.edit', ['pet' => $pet]);


        $pet = $this->petRepository->find($id);

        // Ensure the user is authenticated and get their details
        $user = Auth()->user();

        // Check if pet and user data are available
        if (!$pet) {
            abort(404, 'Pet not found');
        }

        // Return the view with the pet and user data
        return Inertia::render('Pet/edit', [
            'pet' => $pet,
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {

         $pet = $this->petRepository->find($id);

        if (!$pet) {
            return redirect()->route('pets')->with('error', 'Pet not found!');
        }

        $pet->petname = $request->input('petname');
        $pet->category = $request->input('category');
        $pet->breed = $request->input('breed');
        $pet->age = $request->input('age');
        $pet->gender = $request->input('gender');
        $pet->story = $request->input('story');
        $pet->is_adopted = $request->input('is_adopted');
        $pet->address = $request->input('address');
        $pet->phone = $request->input('phone');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $pet->image = $imagePath;
        }
//
      $save =  $this->petRepository->update($id, $pet->toArray());
        if ($save) {
            return redirect()->route('pets.show', ['id' => $id])->with('message', 'Pet updated successfully!');
        }

//        return redirect()->route('pets.show', $pet->id)->with('message', 'Pet updated successfully!');
    }



    public function destroy($id)
    {
        $pet = $this->petRepository->find($id);

        if (!$pet) {
            return redirect()->route('pets')->with('error', 'Pet not found!');
        }

        // Use the petRepository to delete the pet
        $deleted = $this->petRepository->delete($id);

        if ($deleted) {
            return redirect()->route('pet')->with('message', 'Pet deleted successfully!');
        } else {
            return redirect()->route('pet')->with('error', 'Failed to delete pet.');
        }
    }
}
