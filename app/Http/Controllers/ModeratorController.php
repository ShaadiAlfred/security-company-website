<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ModeratorController extends Controller
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
        $pageTitle = trans('All Moderators');

        $moderators = User::whereHas('role', function ($q) {
            $q->whereName('Moderator');
        })->get();

        return view('moderators.index', [
            'pageTitle' => $pageTitle,
            'moderators' => $moderators,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = trans('Add Moderator');

        return view('moderators.create')->with('pageTitle', $pageTitle);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'role_id'           => Role::whereName('Moderator')->first()->id,
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ]);

        if ($request->hasFile('picture')) {
            $validatedPicture = $request->validate([
                'picture' => 'image'
            ]);

            $savedPicture = basename(Storage::disk('public')
                                ->put($this->getPicturesPath(), $validatedPicture['picture']));

            $user->picture = $savedPicture;
            $user->save();
        }

        return back()->with('success', 'Moderator was created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (! $user->isModerator()) {
            return abort(404);
        }

        $pageTitle = $user->name;

        return view('moderators.show', [
            'pageTitle' => $pageTitle,
            'moderator' => $user,
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
        $pageTile = trans('Edit Moderator');

        return view('moderators.edit', [
            'pageTitle' => $pageTile,
            'moderator' => $user,
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

        return back()->with('success', 'Moderator was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response('Success', 200);
    }
}
