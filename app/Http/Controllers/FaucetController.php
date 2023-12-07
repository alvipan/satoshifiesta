<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameHistory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaucetController extends Controller
{
    public function roll(Request $request) {
        $this->data = $this->data();
        $input = $request->input();

        if ($this->available()) {
            $number = $this->number();
            $reward = $this->reward($number);
            $bonus  = $this->bonus();

            Auth::user()->add_balance(
                Auth::user()->active_coin,
                $this->reward($number)
            );

            $transaction = Transaction::create([
                'uid'       => Auth::id(),
                'type'      => 'faucet',
                'currency'  => Auth::user()->active_coin,
                'amount'    => $reward,
                'status'    => 'success'
            ]);

            $history = GameHistory::create([
                'uid'               => Auth::id(),
                'name'              => 'faucet',
                'result'            => $this->number_string($number),
                'reward_type'       => 'balance',
                'reward_content'    => $transaction->id
            ]);

            return [
                'success' => true,
                'data' => [
                    'number'    => $number,
                    'reward'    => number_format($reward, 8),
                    'bonus'     => $bonus,
                    'currency'  => $transaction->currency,
                    'datetime'  => date('Y-m-d H:i:s'),
                ],
            ];
        }
        return [
            'success'   => false,
            'message'   => 'Rolls not yet available.'
        ];
    }

    private function number() {
        $number = array();
        for ($i = 0; $i < 5; $i++) {
            $rand = rand(0, 99999);
            array_push($number, ($rand < 99000) ? rand(0, 8) : 9);
        }
        return $number;
    }

    private function number_string($number) {
        $str = '';
        for ($i = 0; $i < 5; $i++) {
            $str .= $number[$i];
        }
        return $str;
    }

    private function reward($number) {
        $count = count(array_keys($number, 9));
        return $this->data['reward'][$count];
    }

    private function bonus() {
        return 0;
    }

    private function available() {
        $game = Game::firstWhere('name', 'faucet');
	    $history = Transaction::where('uid', Auth::id())
            ->where('type','faucet')
            ->orderBy('created_at', 'desc')
            ->first();

        $timer = $game->timer * 60;
        $last  = $history ? strtotime($history->created_at) : 0;

        return ($timer + $last) < time();
    }

    public function data() {
        $game = Game::firstWhere('name', 'faucet');
	    $history = Transaction::where('uid', Auth::id())
                    ->where('type','faucet')
                    ->orderBy('created_at', 'desc')
                    ->first();

        return [
            'time'      => time(),
            'timer'     => $game->timer * 60,
            'last'      => $history ? strtotime($history->created_at) : 0,
            'reward'    => json_decode($game->reward)
        ];
    }
}
