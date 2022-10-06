<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CreateQrCodeController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'fill' => 'required',
            'background' => 'required',
            'size' => 'required',
            'content' => 'required'
        ]);

        $fill = explode(',', str_replace(['rgba', '(', ')'], '', $data['fill']));
        $bg = explode(',', str_replace(['rgba', '(', ')'], '', $data['background']));
        $qr = QrCode::size($data['size'])
            ->color($fill[0], $fill[1], $fill[2])
            ->backgroundColor($bg[0], $bg[1], $bg[2])
            ->generate($data['content']);
        if ($qr) {
            $qr_model = new Qr();
            $qr_model->content = $data['content'];
            $qr_model->size = $data['size'];
            $qr_model->qr = strval($qr);
            $qr_model->user_id = Auth::user()->id;
            $qr_model->save();
        }
        return response()->json(strval($qr),200);
    }
}
