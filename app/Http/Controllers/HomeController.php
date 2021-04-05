<?php

namespace App\Http\Controllers;

use App\Models\Election_count;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Auth::user()->is_admin == 1) {
            return redirect('/subjects');
        } else {
            $subjects = Subjects::where('status', 'active')->get();
            return view('home', compact('subjects'));
        }
    }

    public function selectSubject(Request $request)
    {
        $check = Election_count::where('user_id', Auth::user()->id)->where('subject_id', $request->subject)->count();

        if ($check == 0) {
            $subjects = Subjects::where('status', 'active')->get();
            return redirect('/')->with(['is_select_subject' => true, 'id' => $request->subject]);
        } else {
            return redirect('/')->with(['is_select_subject' => false, 'alert' => 'exist']);
        }
    }

    public function election(Request $request)
    {
        $election_count = new Election_count;
        $election_count->user_id = Auth::user()->id;
        $election_count->subject_id = $request->subject_id;
        $election_count->choice = $request->subject_choice;

        try {
            if ($election_count->save()) {
                return redirect('/')->with(['alert' => 'insert_success']);
            } else {
                return redirect('/')->with(['alert' => 'not_insert']);
            }
        } catch (\Throwable $th) {
            return redirect('/')->with(['alert' => 'not_insert']);
        }
    }

    public function dashboard($id)
    {
        if (Auth::user()->is_admin == 1) {
            $count = Election_count::groupBy('choice')->select(DB::raw('count(subject_id) as count, choice'))->where('subject_id', $id)->get();

            $yes = Election_count::groupBy('choice')->select(DB::raw('count(subject_id) as count, choice'))->where('subject_id', $id)->where('choice', 'yes')->count();

            $no = Election_count::groupBy('choice')->select(DB::raw('count(subject_id) as count, choice'))->where('subject_id', $id)->where('choice', 'no')->count();

            $mute = Election_count::groupBy('choice')->select(DB::raw('count(subject_id) as count, choice'))->where('subject_id', $id)->where('choice', 'mute')->count();

            $all_count = Election_count::where('subject_id', $id)->count();

            $user_count = User::where('is_admin', '0')->where('enabled', '1')->count();

            return view('dashboard', compact('count', 'all_count', 'user_count', 'yes', 'no', 'mute'));
        } else {
            return redirect('/');
        }
    }

    public function subjects()
    {
        if (Auth::user()->is_admin == 1) {
            $subjects = Subjects::all();

            return view('subjects', compact('subjects'));
        } else {
            return redirect('/');
        }
    }

    public function addSubject(Request $request)
    {
        if (Auth::user()->is_admin == 1) {
            $subject = new Subjects;
            $subject->name = $request->subject_name;
            $subject->detail = $request->detail;
            $subject->status = "active";

            try {
                if ($subject->save()) {
                    return redirect('subjects')->with(['alert' => 'insert_success']);
                } else {
                    return redirect('subjects')->with(['alert' => 'not_insert']);
                }
            } catch (\Throwable $th) {
                return redirect('subjects')->with(['alert' => 'not_insert']);
            }
        } else {
            return redirect('/');
        }
    }

    public function editSubject($id)
    {
        if (Auth::user()->is_admin == 1) {
            $subject = Subjects::where('id', $id)->first();
            return view('editSubject', compact('subject'));
        } else {
            return redirect('/');
        }
    }

    public function updateSubject(Request $request)
    {
        if (Auth::user()->is_admin == 1) {
            $subject = [
                'name' => $request->subject_name,
                'detail' => $request->detail,
            ];

            if (Subjects::where('id', $request->id)->update($subject)) {
                return redirect('subjects')->with(['alert' => 'insert_success']);
            } else {
                return redirect('subjects')->with(['alert' => 'not_insert']);
            }
        } else {
            return redirect('/');
        }
    }

    public function closeSubject($id)
    {
        if (Auth::user()->is_admin == 1) {
            $subject = [
                'status' => "close",
            ];

            if (Subjects::where('id', $id)->update($subject)) {
                return redirect('subjects')->with(['alert' => 'insert_success']);
            } else {
                return redirect('subjects')->with(['alert' => 'not_insert']);
            }
        } else {
            return redirect('/');
        }
    }

    public function enableSubject($id)
    {
        if (Auth::user()->is_admin == 1) {
            $subject = [
                'status' => "active",
            ];

            if (Subjects::where('id', $id)->update($subject)) {
                return redirect('subjects')->with(['alert' => 'insert_success']);
            } else {
                return redirect('subjects')->with(['alert' => 'not_insert']);
            }
        } else {
            return redirect('/');
        }
    }
}
