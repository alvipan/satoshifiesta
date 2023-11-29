<div class="row">

  <div class="col-4 col-xl-3 me-xl-4 mb-xl-0 mb-4 fade-in-top text-center pt-3">
    <img src="/assets/img/illustrations/intro-satoshifiesta.svg" class="w-100"/>
  </div>

  <div class="col my-auto fade-in-right">

    <h2><span class="text-warning">FREE BITCOIN</span> EVERY HOUR!</h2>
    <p>SatoshiFiesta new Bitcoin Faucet where you can have fun and win free Bitcoin instantly. Become a Party Member now!</p>

		@auth
    <a class="btn btn-outline-warning" href="/faucet">Play Now <i class="far fa-play-circle"></i></a>
		@else
		<button class="btn btn-outline-warning" data-bs-togle="modal" data-bs-target="#modal-connect">Play Now</button>
		@endauth

  </div>

  <div class="col-12 col-xl-9 ms-xl-auto mt-xl-n5">
    <div class="card mb-2">
      <div class="card-body text-xs text-secondary">
        <div class="row justify-content-center text-center">

          <div class="col-4 p-0 border-end border-dark">
            <a class="d-block d-xl-flex justify-content-center align-items-start" href="/faucet">
              <div>
                <span class="d-block">Free Bitcoin</span>
                <span class="text-xxs text-secondary">Claim bitcoin every hour</span>
              </div>
            </a>
          </div>

          <div class="col-4 p-0 border-end border-dark">
            <a class="d-block d-xl-flex justify-content-center align-items-start" href="/slot">
              <div>
                <span class="d-block">Slot Game</span>
                <span class="text-xxs text-secondary">Shuffle and get Jackpot</span>
              </div>
            </a>
          </div>

          <div class="col-4 p-0">
            <a class="d-block d-xl-flex justify-content-center align-items-start" href="/vip">
              <div>
                <span class="d-block">VIP Membership</span>
                <span class="text-xxs text-secondary">Get more profit</span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>