<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Jobs\SendMailJob;
use App\Jobs\SendVerifyEmailJob;
use App\Mail\NotificationEmail;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {

        return $dataTable->render('users.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        $data = $request->validated();

        if($request->hasFile("avatar_image")){
            $path = $request->file("avatar_image")
                ->store('',["disk"=>"avatars"]);

            $data["avatar_image"] = $path;
        }

        $user = User::create($data);
        $user->assignRole("client");
        SendVerifyEmailJob::dispatch($user);


        return redirect()->route("users.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view("users.show",["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view("users.edit",["user"=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        $data["password"] = isset($request->password)
                            ? $request->password
                            : $user->password;

        if ($request->hasFile("avatar_image"))
        {
            Storage::disk("avatars")->delete($user->avatar_image);
            $data["avatar_image"] = $request->file("avatar_image")
                                    ->store('',["disk"=>"avatars"]);
        }
//        dd($data);

        $user->update($data);

        return redirect()->route("users.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->hasRole("admin")){
            return response()->json([
                'error' => "sorry you can't delete admin.",
            ], 200);
        }

        if( $user->hasRole("pharmacy") && $user->pharmacy()->count() ){
            return response()->json([
                'error' => "sorry you can't delete pharmacy owner before deleting his pharmacy first.",
            ], 200);
        }
        if($user->hasRole("doctor")){
            return response()->json([
                'success' => "you deleted this user successfully.",
            ], 200);
        }

        if($user->orders()->count()){
            return response()->json([
                'error' => "you can't delete This Medicine This Medicine has Orders Assigned to this order.",
            ], 200);
        }
        $user->delete();
        return response()->json([
            'success' => "you deleted user $user->name successfully.",
        ], 200);



//        return redirect()->route("users.index");
    }


    /**
     * Ban Doctor user.
     */
    public function ban(User $doctor)
    {
        if(
            auth()->user()->hasRole("admin")
            ||
            (
                auth()->user()->hasRole("pharmacy")
                && auth()->user()->pharmacy_id === $doctor->pharmacy_id
            )
        )
        {
            $doctor->ban();

            session()->flash('success', 'User banned successfully');
            return redirect()->route("doctors.index");

        }

        session()->flash('error', 'You are not authorized');

        return redirect()->route("doctors.index");

    }


    /**
     * Unban Doctor user.
     */
    public function unban(User $doctor)
    {
        if(
            auth()->user()->hasRole("admin")
            ||
            (
                auth()->user()->hasRole("pharmacy")
                && auth()->user()->pharmacy_id === $doctor->pharmacy_id
            )
        )
        {
            $doctor->unban();

            session()->flash('success', 'User unbanned successfully');
            return redirect()->route("doctors.index");

        }

        session()->flash('error', 'You are not authorized');

        return redirect()->route("doctors.index");

    }
    /**
     * Show the form for Entring User email for sending the reset message .
     */
    public function resetPasswordWithEmail () {

        return view ('auth.passwords.email');

    }

}
