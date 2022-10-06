<?php

namespace Tests\Feature;

use App\Models\Qr;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Tests\TestCase;

class QrCodeTest extends TestCase
{
    use RefreshDatabase;
    public function testCreate()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);

        $response = $this
            ->actingAs($user, 'sanctum')
            ->post('/api/qr', [
            'content' => 'Some title',
            'size' => '128',
            'fill' => 'rgba(0,0,0)',
            'background' => 'rgba(255,255,255)'
        ]);

        $this->assertDatabaseCount('qrs', 1);

        $this->assertDatabaseHas('qrs', [ 'content' => 'Some title', 'size' => '128' ]);



        $response->assertStatus(200);
    }

    public function testDelete() {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);

        $qrCode = QrCode::size(128)
            ->color(0,0,0)
            ->backgroundColor(255,255,255)
            ->generate('Some title');

        $qr = Qr::create([
            'id' => '10',
            'user_id' => $user->id,
            'content' => 'Some title',
            'qr' => strval($qrCode),
            'size' => '128',
        ]);

        $this->assertDatabaseHas('qrs', [
            'id' => '10',
            'content' => 'Some title',
        ]);

        $response = $this->delete('/api/delete/qr/'.$qr->id);

        $response->assertStatus(302);
    }
}
