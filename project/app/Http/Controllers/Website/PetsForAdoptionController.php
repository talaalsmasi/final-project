<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetsForAdoptionController extends Controller
{
    public function index(Request $request)
    {
        // الحصول على نوع الحيوان الممرر من الرابط، إذا كان موجوداً
        $animalType = $request->query('type');

        // جلب الحيوانات التي أصحابها يحملون role_id = 1 وفلترتها حسب نوع الحيوان إذا تم تمرير `type`
        $pets = Pet::whereHas('user', function ($query) {
            $query->where('role_id', 1);
        })
        ->when($animalType, function ($query, $animalType) {
            return $query->where('animal_type_id', $animalType);
        })
        ->get();

        return view('adoptions.petsForAdoption', compact('pets'));
    }


    public function showAdoptionForm($id)
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // Find the pet by its ID
            $pet = Pet::findOrFail($id);

            // Return the view with the pet's details
            return view('adoptions.adoptionRequest', compact('pet'));
        } else {
            // If the user is not authenticated, redirect to the login page with a message
            return redirect()->route('login')->with('error', 'You need to log in first.');
        }
    }

    // Method to submit the adoption request
    public function submitAdoption(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        // Validate form data
        $request->validate([
            'reason' => 'required|string',
            'can_feed' => 'required|in:yes,no',
            'can_treat' => 'required|in:yes,no',
            'has_other_pets' => 'required|in:yes,no',
        ]);

        // Create a new adoption request
        Adoption::create([
            'user_id' => auth()->id(),
            'pet_id' => $pet->id,
            'reason' => $request->reason,
            'can_feed' => $request->can_feed === 'yes',
            'can_treat' => $request->can_treat === 'yes',
            'has_other_pets' => $request->has_other_pets === 'yes',
            'status' => 'pending', // Set the status to pending
        ]);

        // Redirect with a success message
        return redirect()->route('profile')->with('message', 'Adoption request submitted successfully.');
    }

    public function showRequest()
    {
        // جلب طلبات التبني الخاصة بالمستخدم الحالي
        $adoptionRequests = Adoption::where('user_id', auth()->id())->with('pet')->get();

        // تمرير الطلبات إلى صفحة العرض
        return view('adoptions.showAdoptionRequest', compact('adoptionRequests'));
    }

    // Method to cancel an adoption request
    public function cancelRequest($id)
    {
        // Find the adoption request by ID
        $adoptionRequest = Adoption::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete the request
        $adoptionRequest->delete();

        // Redirect to the profile with a success message
        return redirect()->route('profile')->with('success', 'Adoption request has been cancelled.');
    }
}
