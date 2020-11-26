<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Get the path of users' profile pictures
     */
    private function getPicturesPath(): string
    {
        return User::$picturesPath;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $pageTitle = $user->name;

        return view('admins.show', [
            'pageTitle' => $pageTitle,
            'admin'     => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $pageTile = trans('Edit Admin');

        return view('admins.edit', [
            'pageTitle' => $pageTile,
            'admin' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validationRules = [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ];

        if (! is_null($request->password)) {
            $validationRules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        $validatedData = $request->validate($validationRules);

        if (array_key_exists('password', $validatedData)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        if ($request->hasFile('picture')) {
            $validatedPicture = $request->validate([
                'picture' => 'image'
            ]);
            $validatedPicture = $validatedPicture['picture'];

            $savedPicture = basename(Storage::disk('public')->put($this->getPicturesPath(), $validatedPicture));

            if ($user->picture !== 'default.png') {
                Storage::disk('public')->delete($this->getPicturesPath() . $user->picture);
            }

            $user->picture = $savedPicture;
            $user->save();
        }

        return back()->with('success', 'Admin was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
