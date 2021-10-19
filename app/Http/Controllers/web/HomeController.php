<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['exam'] = Exam::paginate(6);
        return view('web.home.index')->with($data);
    }
}
