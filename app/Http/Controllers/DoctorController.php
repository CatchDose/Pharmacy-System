<?php

namespace App\Http\Controllers;

use App\DataTables\DoctorDataTable;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Jobs\SendVerifyEmailJob;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DoctorDataTable $dataTable)
    {

        return $dataTable->render('doctors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pharmacies = Pharmacy::all();
        if (auth()->user()->hasRole("pharmacy")) {
            $pharmacies = Pharmacy::where("id", auth()->user()->pharmacy_id)->get();
        }

        return view("doctors.create", ["pharmacies" => $pharmacies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {

        $data = $request->validated();

        if ($request->hasFile("avatar_image")) {
            $path = $request->file("avatar_image")
                ->store('', ["disk" => "avatars"]);

            $data["avatar_image"] = $path;
        }
        if (auth()->user()->hasRole("pharmacy")) {
            $data["pharmacy_id"] = auth()->user()->pharmacy_id;
        }

        $user = User::create($data);

        $user->assignRole("doctor");
        SendVerifyEmailJob::dispatch($user);

        return redirect()->route("doctors.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        return redirect()->route("doctors.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $doctor)
    {
        $pharmacies = Pharmacy::all();
        return view("doctors.edit", ["doctor" => $doctor, "pharmacies" => $pharmacies]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, User $doctor)
    {
        $data = $request->validated();

        $data["password"] = isset($request->password)
            ? $request->password
            : $doctor->password;

        if ($request->hasFile("avatar_image")) {
            Storage::disk("avatars")->delete($doctor->avatar_image);
            $data["avatar_image"] = $request->file("avatar_image")
                ->store('', ["disk" => "avatars"]);
        }
        if (auth()->user()->hasRole("pharmacy")) {
            $data["pharmacy_id"] = auth()->user()->pharmacy_id;
        }
        $doctor->update($data);

        return redirect()->route("doctors.index");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = user::find($id);
        if (
            auth()->user()->hasRole("admin") ||
            (auth()->user()->hasRole(["pharmacy"]) && auth()->user()->pharmacy_id == $user->pharmacy_id)
        ) {
            $user->delete();
            return response()->json([
                'success' => "Doctor was deleted successfully.",
            ], 200);
        }
        return response()->json([
            'error' => "Doctor couldn't be delete",
        ], 200);
    }
}
