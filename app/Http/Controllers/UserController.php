<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Tables\UsersTable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FileUploads\ExistingFile;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('users_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access users');

        return view('users.index', [
            'users' => UsersTable::class
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        $validated = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,NULL,id',
            //'roles' => 'required'
        ]);

        return DB::transaction(function () use ($validated) {

            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->save();

            // $user->roles()->sync($validated['roles']);

            Toast::title('User created successfully')->autoDismiss(3);

            return redirect()->route('users.index');
        });
    }

    public function show(User $user)
    {
        $user->load('roles:id,name');

        $supervisors = [];

        $user->signature = ($media = $user->getFirstMedia('signatures')) ? $media->getUrl() : '';

        return view('users.show', compact('user', 'supervisors'));
    }

    public function edit(User $user)
    {
        $user->signature = ExistingFile::fromMediaLibrary($user->getFirstMedia('signatures'));

        return view('users.edit', [
            'user' => $user->load('roles'),
            'roles' => Role::pluck('name', 'id')
        ]);
    }

    public function update(User $user)
    {
        $validated = request()->validate([
            'name' => 'required|max:255',
            'email' => "required|unique:users,email,{$user->id},id",
            'roles' => 'required',
            'status' => 'required',
        ]);

        return DB::transaction(function () use ($validated, $user) {

            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->status = $validated['status'];
            // $user->password = Hash::make($validated['password']);
            $user->save();

            $user->roles()->sync($validated['roles']);

            if (request()->hasFile('signature')) {
                $user->addMediaFromRequest('signature')->toMediaCollection('signatures');
            }

            Toast::title('User updated successfully')->autoDismiss(3);

            return redirect()->back();
        });
    }

    public function destroy(User $user)
    {
        return DB::transaction(function () use ($user) {
            Toast::title('User deleted successfully')->autoDismiss(3);

            return redirect()->route('users.index');
        });
    }

    public function destroySignature(User $user)
    {
        $user->clearMediaCollection('signatures');

        Toast::title('User signature deleted successfully')->autoDismiss(3);

        return redirect()->back();
    }
}