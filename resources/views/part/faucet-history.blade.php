@php
use App\Models\GameHistory;
use App\Models\Transaction;

$histories = Auth::check() 
	? GameHistory::where(['name' => 'faucet', 'uid' => Auth::user()->id])
	: GameHistory::where(['name' => 'faucet']);
@endphp

<div class="card h-100">
	<div class="card-header">
		<h6 class="mb-0">History</h6>
	</div>
	<table class="table text-center mb-1">
		<thead>
			<th>DATE/TIME</th>
			<th>NUMBER</th>
			<th>REWARD</th>
		</thead>
		<tbody id="roll-history">
			@forelse ($histories->get() as $history)
			@php
			$transaction = Transaction::firstWhere('id', $history->reward_content)
			@endphp
			<tr class="roll-history-item">
				<td>{{$history->created_at}}</td>
				<td class="font-monospace">{{$history->result}}</td>
				<td>
					{{$transaction->amount}}
					{{$transaction->currency}}
				</td>
			</tr>
			@empty
			<tr>
				<td colspan="3">No history</td>
			</tr>
			@endforelse
		</tbody>
	</table>
</div>