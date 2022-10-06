<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetQrCodesController extends Controller
{
    public function __invoke()
    {
        $qrs = Auth::user()->qrs;
        return response()->json($qrs, 200);
    }
}
