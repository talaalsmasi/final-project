<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\AnimalType;
use Illuminate\Http\Request;

class AnimalTypeController extends Controller
{
    public function index()
    {
        $animalTypes = AnimalType::all();
        return view('admin.animaltypes.index', compact('animalTypes'));
    }

    public function create()
    {
        return view('admin.animaltypes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
        ]);

        AnimalType::create($request->all());

        return redirect()->route('admin.animaltypes.index')->with('success', 'Animal Type created successfully.');
    }

    public function edit($id)
    {
        $animalType = AnimalType::findOrFail($id);
        return view('admin.animaltypes.edit', compact('animalType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
        ]);

        $animalType = AnimalType::findOrFail($id);
        $animalType->update($request->all());

        return redirect()->route('admin.animaltypes.index')->with('success', 'Animal Type updated successfully.');
    }

    public function destroy($id)
    {
        $animalType = AnimalType::findOrFail($id);
        $animalType->delete();

        return redirect()->route('admin.animaltypes.index')->with('success', 'Animal Type deleted successfully.');
    }
}
