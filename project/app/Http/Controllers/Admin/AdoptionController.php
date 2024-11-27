<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use App\Models\Pet;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    // عرض جميع طلبات التبني
    public function index()
    {
        $adoptions = Adoption::with(['pet', 'user'])->get();
        return view('Admin.adoptions.index', compact('adoptions'));
    }

    // عرض تفاصيل طلب التبني
    public function show(Adoption $adoption)
    {
        return view('Admin.adoptions.show', compact('adoption'));
    }

    // عرض نموذج إنشاء طلب تبني
    public function create()
    {
        $pets = Pet::whereHas('user', function($query) {
            $query->where('role_id', 1); // فقط الحيوانات التي يملكها مستخدمين role_id = 1
        })->get();

        return view('Admin.adoptions.create', compact('pets'));
    }

    // تخزين طلب التبني
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'pet_id' => 'required|exists:pets,id',
            'reason' => 'required',
            'can_feed' => 'required|boolean',
            'can_treat' => 'required|boolean',
            'has_other_pets' => 'required|boolean',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        Adoption::create($request->all());

        return redirect()->route('admin.adoptions.index')->with('success', 'Adoption request created successfully.');
    }

    // عرض نموذج تعديل طلب التبني
    public function edit(Adoption $adoption)
    {
        return view('Admin.adoptions.edit', compact('adoption'));
    }

    // تحديث طلب التبني
    public function update(Request $request, Adoption $adoption)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // إذا كانت الحالة "approved"، يتم نقل ملكية الحيوان
        if ($request->status === 'approved') {
            $adoption->pet->update(['user_id' => $adoption->user_id]);
        }

        $adoption->update($request->all());

        return redirect()->route('admin.adoptions.index')->with('success', 'Adoption request updated successfully.');
    }

    // حذف طلب التبني
    public function destroy(Adoption $adoption)
    {
        $adoption->delete();

        return redirect()->route('admin.adoptions.index')->with('success', 'Adoption request deleted successfully.');
    }
}
