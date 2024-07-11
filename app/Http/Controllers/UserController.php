<?php

namespace App\Http\Controllers;

use App\Exports\UsersDataExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\User;
use App\Events\UserLog;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('id')->get();

        return view('user', [
            'users' => $users
        ]);
    }

    public function exportExcel() {
        return Excel::download(new UsersDataExport, 'users-data.xlsx');
    }

    public function store(Request $request)
    {
        // abort_if(Gate::denies('create user'), 403);
        abort_if(Gate::denies('create user'), 403);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

         $users = User::create($validatedData);

        $log_entry = 'Added a new user ' . $users->name . ' with the ID# of ' . $users->id;
        event(new UserLog($log_entry));



        return redirect()->route('user')->with('success', 'User created successfully.');
    }

    public function edit(User $user) {
        abort_if(Gate::denies('update user'), 403);
        return view('edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        abort_if(Gate::denies('edit user'), 403);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->update($request->only('name', 'email', 'password'));

        $log_entry = 'Added a new user ' . $user->name . ' with the ID# of ' . $user->id;
        event(new UserLog($log_entry));

        return redirect()->route('user')->with('success', 'User updated successfully.');
    }


    public function destroy(User $user) {
        abort_if(Gate::denies('delete user'), 403);
        $user->delete();

        $log_entry = 'Deleted the user ' . $user->name . ' with the ID# of ' . $user->id;
        event(new UserLog($log_entry));

        return redirect()->route('user');
    }

    public function logs()
    {
        abort_if(Gate::denies('visit logs'), 403);
        $logs = auth()->user()->logs;
        return view('logs', compact('logs'));
    }
}
