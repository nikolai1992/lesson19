<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Subject;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function rating()
    {
        $subjects = Subject::all();
        return view('rating.index', compact('subjects'));
    }
    public function update_rating(Request $request)
    {
        $this->validate($request, [
            'rating' => 'numeric'
        ]);
        DB::table('student_subject')->where('student_id', $request->student_id)->where('subject_id', $request->subject_id)->update(['rating'=> $request->rating]);
        return redirect()->back();
    }
    public function index()
    {
        return view('home');
    }
}
