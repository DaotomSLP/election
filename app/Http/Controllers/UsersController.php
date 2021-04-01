<?php

namespace App\Http\Controllers;

use App\Models\Branchs;
use App\Models\Districts;
use App\Models\Provinces;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if (Auth::user()->is_admin == 1) {
            $users = User::all();

            return view('users', compact('users'));
        } else {
            return redirect('/');
        }
    }


    public function insert(Request $request)
    {
        if (Auth::user()->is_admin == 1) {
            $user = new User;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_admin = '0';
            $user->enabled = '1';

            try {
                if ($user->save()) {
                    return redirect('users')->with(['alert' => 'insert_success']);
                } else {
                    return redirect('users')->with(['alert' => 'not_insert']);
                }
            } catch (\Throwable $th) {
                return redirect('users')->with(['alert' => 'not_insert']);
            }
        } else {
            return redirect('/');
        }
    }

    public function edit($id)
    {
        if (Auth::user()->is_admin == 1) {
            $user = User::where('id', $id)->first();
            return view('editUser', compact('user'));
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request)
    {
        if (Auth::user()->is_admin == 1) {
            $user = [
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => Auth::user()->id == $request->id ? '1' : '0',
            ];

            if (User::where('id', $request->id)->update($user)) {
                return redirect('users')->with(['alert' => 'insert_success']);
            } else {
                return redirect('users')->with(['alert' => 'not_insert']);
            }
        } else {
            return redirect('/');
        }
    }

    public function delete($id)
    {
        if (Auth::user()->is_admin == 1) {
            $user = [
                'enabled' => "0"
            ];

            if (User::where('id', $id)->update($user)) {
                return redirect('users')->with(['alert' => 'insert_success']);
            } else {
                return redirect('users')->with(['alert' => 'not_insert']);
            }
        } else {
            return redirect('/');
        }
    }

    public function open($id)
    {
        if (Auth::user()->is_admin == 1) {
            $user = [
                'enabled' => "1"
            ];

            if (User::where('id', $id)->update($user)) {
                return redirect('users')->with(['alert' => 'insert_success']);
            } else {
                return redirect('users')->with(['alert' => 'not_insert']);
            }
        } else {
            return redirect('/');
        }
    }

    public function admin(Request $request)
    {

        $result = User::query();

        $result->select('users.*')
            ->where('branch_id', NULL)
            // ->where('is_owner', 0)
            ->where('percent', NULL);

        if ($request->name != '') {
            $result->where('users.name', $request->name);
        }

        if ($request->enabled != '') {
            if ($request->enabled == "1") {
                $result->where('users.enabled', '1');
            } else {
                $result->where('users.enabled', '<>', '1');
            }
        }

        if ($request->email != '') {
            $result->where('email', $request->email);
        }

        $all_users = $result->orderBy('users.id', 'desc')
            ->get();

        if ($request->page != '') {
            $result->offset(($request->page - 1) * 25);
        }

        $users = $result->orderBy('users.id', 'desc')
            ->limit(25)
            ->get();

        $pagination = [
            'offsets' =>  ceil(sizeof($all_users) / 25),
            'offset' => $request->page ? $request->page : 1,
            'all' => sizeof($all_users)
        ];

        return view('admin', compact('users', 'pagination'));
    }

    public function insertAdmin(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = '1';
        $user->enabled = '1';
        $user->phone_no = $request->phone_no;
        $user->is_owner = '0';

        try {
            if ($user->save()) {
                return redirect('admin')->with(['error' => 'insert_success']);
            } else {
                return redirect('admin')->with(['error' => 'not_insert']);
            }
        } catch (\Throwable $th) {
            return redirect('admin')->with(['error' => 'not_insert']);
        }
    }

    public function editAdmin($id)
    {
        $user = User::where('id', $id)->first();

        return view('editAdmin', compact('user'));
    }

    public function updateAdmin(Request $request)
    {
        $user = [
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'enabled' => '1',
            'phone_no' => $request->phone_no,
        ];

        if (User::where('id', $request->id)->update($user)) {
            return redirect('admin')->with(['error' => 'insert_success']);
        } else {
            return redirect('admin')->with(['error' => 'not_insert']);
        }
    }
}
