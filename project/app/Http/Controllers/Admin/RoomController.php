<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        // استرداد جميع الغرف لعرضها
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        // عرض صفحة إنشاء غرفة جديدة
        return view('admin.rooms.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'room_name' => 'required|string|max:255',
            'room_type' => 'required|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable', // تحقق من الصورة
        ]);

        if ($request->hasFile('image')) {
            // احصل على اسم الملف الأصلي وقم بتوليد اسم فريد
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();

            // قم بنقل الصورة إلى مجلد التخزين (public/img/pets)
            $request->file('image')->move(public_path('img/rooms'), $imageName);

            // حفظ المسار بشكل صحيح في قاعدة البيانات
            $data['image'] = 'img/rooms/' . $imageName; // تم تعديل $validatedData إلى $data
        }




        // حفظ بيانات الغرفة في قاعدة البيانات
        Room::create($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully.');
    }



    public function show($id)
    {
        // استرداد غرفة معينة
        $room = Room::findOrFail($id);
        return view('admin.rooms.show', compact('room'));
    }

    public function edit($id)
    {
        // تعديل غرفة معينة
        $room = Room::findOrFail($id);
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $data = $request->validate([
            'room_name' => 'required|string|max:255',
            'room_type' => 'required|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if a new one is uploaded
            if ($room->image && file_exists(public_path($room->image))) {
                unlink(public_path($room->image));
            }

            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/rooms'), $imageName); // Save the new image
            $data['image'] = 'images/rooms/'.$imageName;
        }

        $room->update($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully.');
    }


    public function destroy($id)
    {
        // حذف غرفة معينة
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
    }
}
