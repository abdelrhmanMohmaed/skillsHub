<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Exception;


use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index()
    {
        $data['cats'] = Cat::orderBy('id', 'DESC')->Paginate(10);
        return view('admin.cats.index')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);

        Cat::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
        ]);
        $request->session()->flash('msg', 'row create successfuly');
        return back();
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:cats,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);

        Cat::findOrFail($request->id)->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
        ]);
        $request->session()->flash('msg', 'row updated successfully');
        return back();
    }
    // public function delete($id)
    // {
    //     $data['cats'] = Cat::findOrFail($id);
    //     $data['cats']->delete();
    //     return back();
    // }  
    public function delete(Cat $cat, Request $request)
    {
        try {
            $cat->delete();
            $msg = "row deleted successfully";
        } catch (Exception $e) {
            $msg = "Can't delete this row";
        }
        $request->session()->flash('msg', $msg);
        return back();
    }
    public function toggle(Cat $cat, Request $request)
    {
        $cat->update([
            'active' => !$cat->active,
        ]);
        $request->session()->flash('msg', 'Switch active successfully');
        return back();
    }
}
