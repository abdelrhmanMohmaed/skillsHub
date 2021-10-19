<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index()
    {
        $data['skills'] = Skill::orderBy('id', 'DESC')->paginate(10);
        $data['cats'] = Cat::select('id', 'name')->get();

        return view('admin.skills.index')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img' => 'required|image|max:2048',
            'cat_id' => 'required|exists:cats,id',
        ]);

        $path = Storage::putFile('skills', $request->file('img'));

        Skill::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' => $path,
            'cat_id' => $request->cat_id,
        ]);

        $request->session()->flash('msg', 'row added successfully');
        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:skills,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img' => 'nullable|image|max:2048',
            'cat_id' => 'required|exists:cats,id',
        ]);

        $skill = Skill::findOrFail($request->id);
        $path = $skill->img;

        if ($request->hasFile('img')) {
            //1-in the first delete the old photoo 
            //2-next add a new photoo in class storge 
            Storage::delete($path);
            $path = Storage::putFile('skills', $request->file('img'));
        }

        $skill->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' => $path,
            'cat_id' => $request->cat_id,
        ]);

        $request->session()->flash('msg', 'row updated successfully');
        return back();
    }

    public function toggle(Skill $skill)
    {
        $skill->update([
            'active' => !$skill->active,
        ]);

        return back();
    }

    public function delete(Skill $skill, Request $request)
    {
        try {
            $path = $skill->img;
            $skill->delete();
            Storage::delete($path);
            $msg = 'row deleted successfully';
        } catch (Exception $e) {
            $msg = "can't delete this row";
        }

        $request->session()->flash('msg', $msg);
        return back();
    }
}
