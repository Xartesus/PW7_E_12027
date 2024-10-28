<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function index()
    {
        $bookings = Bookings::latest()->paginate(5);

        return view('bookings.index', compact('bookings'));
    }
}
