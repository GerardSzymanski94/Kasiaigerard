<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\GuestRepository;
use App\Http\Requests\GuestRequest;
use App\Models\Guest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{
    public function index()
    {
        $guestRepo = new GuestRepository();

        $guests = Guest::all();
        $confirmed = $guestRepo->countConfirmGuests();
        return view('admin.guest.list', compact('guests', 'confirmed'));
    }

    public function store(GuestRequest $request)
    {
        Guest::create($request->validated());
        return redirect()->route('admin.guest.index')->with('success', true);
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return redirect()->route('admin.guest.index')->with('delete', true);
    }

    public function confirm(Guest $guest)
    {
        $guest->confirm = 1;
        $guest->save();
        return redirect()->route('admin.guest.index')->with('status', true);
    }

    public function canceled(Guest $guest)
    {
        $guest->confirm = 0;
        $guest->save();
        return redirect()->route('admin.guest.index')->with('status', true);
    }

    public function edit(Guest $guest)
    {
        return view('admin.guest.edit', compact('guest'));
    }

    public function update(Guest $guest, GuestRequest $request)
    {
        //Guest::create($request->validated());

        $guest->update($request->validated());
        return redirect()->route('admin.guest.index')->with('edit', true);
    }


}
