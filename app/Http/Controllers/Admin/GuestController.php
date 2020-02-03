<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GuestRequest;
use App\Models\Guest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::all();
        return view('admin.guest.list', compact('guests'));
    }

    public function store(GuestRequest $request)
    {
        Guest::create($request->validated());
        // $view = view('guest.guest_input')->render();
        // return response()->json(['view' => $view]);
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
}
