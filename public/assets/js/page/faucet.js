function roll(token = '') {
	$('.btn-roll').addClass('disabled')
	let rolling = setInterval(function() {
		for (let i = 1; i < 6; i++) {
			$(`#slot-${i}`).html(Math.floor(Math.random() * 10));
		}
	}, 100);

	$.get('/faucet/roll', {token:token}, function(res) {
		clearInterval(rolling);
		if (res.success) {
			for (let i = 1; i < 6; i++) {
				$(`#slot-${i}`).html(res.data.number[i-1]);
			}
			alert('Reward: '+res.data.reward);
		}
		$('.btn-roll').removeClass('disabled')
	}, 'json');
}