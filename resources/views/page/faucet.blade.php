<div class="card mt-xl-3 bg-gradient-primary mb-3">
	<div class="row">
		<div class="col-xl-6 me-auto">
			<div class="card-body">
				<h2 class="fw-bold text-white mb-0">FREE COIN EVERY HOURS</h2>
				<span class="text-white font-weight-bold text-sm">Get up to 0.00004096 BTC every hour!</span>

				<div class="row justify-content-center align-items-center mb-3">
					<div class="col-auto pe-0 mt-4">
						<span class="h2 border border-light bg-gradient-primary font-monospace rounded px-2 py-1 py-xl-0" id="slot-1">0</span>
					</div>
					<div class="col-auto pe-1 mt-4">
						<span class="h2 border border-light bg-gradient-primary font-monospace rounded px-2 py-1 py-xl-0" id="slot-2">0</span>
					</div>
					<div class="col-auto pe-1 mt-4">
						<span class="h2 border border-light bg-gradient-primary font-monospace rounded px-2 py-1 py-xl-0" id="slot-3">0</span>
					</div>
					<div class="col-auto pe-1 mt-4">
						<span class="h2 border border-light bg-gradient-primary font-monospace rounded px-2 py-1 py-xl-0" id="slot-4">0</span>
					</div>
					<div class="col-auto mt-4">
						<span class="h2 border border-light bg-gradient-primary font-monospace rounded px-2 py-1 py-xl-0" id="slot-5">0</span>
					</div>
					<div class="col mt-4 ps-1">
						<button id="btn-roll" class="btn btn-primary w-100" onclick="roll()" disabled>ROLL</button>
					</div>
				</div>

				<div class="text-white">
					<span>Until activation:</span>
					<span id="timer" class="font-monospace">00:00</span>
					<div class="progress overflow-hidden mt-1" style="height:10px">
						<div id="progress-bar" class="bg-gradient-success" role="progressbar" style="width: 0%; height:10px"></div>
					</div>
				</div>

			</div>
		</div>
		<div class="col-xl-4 d-none d-xl-block">
			<div class="mt-n5">
				<img class="w-100" src="/assets/img/illustrations/free-box.webp"/>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-4">
		@include('part.faucet-reward')
	</div>
	<div class="col-xl-8">
		@include('part.faucet-history')
	</div>
</diiv>
@include('modal.faucet-roll')
