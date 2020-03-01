<?php

namespace App\Http\Repositories;

use App\Http\Requests\GuestRequest;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestRepository
{

    public function countConfirmGuests()
    {
        $guests = Guest::where('confirm', 1)->get();
        $count = 0;
        foreach ($guests as $guest) {
            $count++;
            $count += $guest->person;
            $count += $guest->childrens;
        }
        return $count;
    }
}