@php
$faucet = App\Models\Game::where('name','faucet')->first();
$rewards = json_decode($faucet->reward);
@endphp

<div class="card mb-3 mb-xl-0">
	<div class="card-header">
		<h6 class="mb-0">Reward List</h6>
	</div>
	<table class="table text-center mb-1">
		<thead>
			<th>Number</th>
			<th>Reward</th>
		</thead>
		<tbody>	
			@for ($i = 0; $i < count($rewards); $i++)
			<tr>
				<td>{{$i}} number 9</td>
				<td>
					<span class="reward">{{number_format($rewards[$i], 8)}}</span>
					<span class="coin">BTC</span>
				</td>
			</tr>
			@endfor
		</tbody>
	</table>
</div>