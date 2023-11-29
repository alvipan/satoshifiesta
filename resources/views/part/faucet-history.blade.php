@php
use App\Models\Transaction;

$transactions = Auth::check() 
	? Transaction::where(['type' => 'faucet', 'uid' => Auth::user()->id])
	: Transaction::where(['type' => 'faucet']);
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
		<tbody>
			@forelse ($transactions->get() as $trx)
			<tr>
				<td>{{$trx->date}}</td>
				<td>{{$trx->number}}</td>
				<td>{{$trx->amount}}</td>
			</tr>
			@empty
			<tr>
				<td colspan="3">No history</td>
			</tr>
			@endforelse
		</tbody>
	</table>
</div>