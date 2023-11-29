<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class FaucetController extends Controller
{
    public function roll(Request $request) {
        $input = $request->input();
        $number = $this->roll_number();
        $reward = $this->roll_reward($number);

        $result = [
            'success' => true,
            'data' => [
                'number' => $number,
                'reward' => number_format($reward, 8)
            ]
        ];
        echo json_encode($result);
    }

    private function roll_number() {
        $number = array();
        for ($i = 0; $i < 5; $i++) {
            $rand = rand(0, 99999);
            array_push($number, ($rand < 99000) ? rand(0, 8) : 9);
        }
        return $number;
    }

    private function roll_reward($number) {
        $rewards = json_decode(Game::where('name','faucet')->first()->reward);
        $count = count(array_keys($number, 9));
        return $rewards[$count];
    }
}
