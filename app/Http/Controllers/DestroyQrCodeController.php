<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use Illuminate\Http\Request;

class DestroyQrCodeController extends Controller
{
    public function __invoke(Request $request)
    {
        Qr::find($request->id)->delete();
        return response()->json(['content' => 'Removed'], 200);
    }
}
