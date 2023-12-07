$.when(
	$.get('/faucet/data', function(res) {
		data.game = res;
		data.modal.faucet_roll = new bootstrap.Modal(document.getElementById('modal-faucet-roll'), {keyboard: false});
	})
).done(function() {
	start_countdown((data.game.timer + data.game.last) * 1000, data.game.timer);
});

function roll() {
	if (!data.user) return data.modal.connect.show();
	$('.btn-roll').addClass('disabled')
	let rolling = setInterval(function() {
		for (let i = 1; i < 6; i++) {
			$(`#slot-${i}`).html(Math.floor(Math.random() * 10));
		}
	}, 100);
 
	$.get('/faucet/roll', {}, function(res) {
		clearInterval(rolling);
		if (res.success) {
			for (let i = 1; i < 6; i++) {
				$(`#slot-${i}`).html(res.data.number[i-1]);
			}
			data.game.last = new Date().getTime();
			
			show_modal(res.data);
			update_history(res.data);
			start_countdown((data.game.timer * 1000) + data.game.last, data.game.timer);
		} else {
			show_alert('alert-danger', res.message);
		}
		$('.btn-roll').removeClass('disabled')
	}, 'json');
}

function show_modal(res) {
	$('#modal-faucet-reward').html(res.reward);
	$('#modal-faucet-currency').html(res.currency);
	data.modal.faucet_roll.show();
}

function update_history(history) {
	let number = '';
	for (let i = 0; i < 5; i++) {
		number += history.number[i];
	}
  let row = `<tr>
		<td>${history.datetime}</td>
		<td>${number}</td>
		<td>${history.reward} ${history.currency}</td>
		</tr>`;

	let history_items = $('#roll-history').find('.roll-history-item').length;
	if ([0, 6].includes(history_items)) $('#roll-history tr:last').remove();
	$('#roll-history').prepend($(row).hide().delay(500).show('slow'));
}

function start_countdown(timer, progress) {
	let i = setInterval(function() {
		let now = new Date().getTime();
		let distance = timer - now;
		
    let min = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let sec = Math.floor((distance % (1000 * 60)) / 1000);
		let s = Math.floor((distance % (1000 * progress)) / 1000);
		let w = (100/progress) * (progress - s);

		min = min < 10 ? `0${min}` : min;
		sec = sec < 10 ? `0${sec}` : sec;

    $("#timer").html(min+':'+sec);
		$("#progress-bar").css('width',w+'%');
		$("#btn-roll").attr('disabled', true);

		if (distance <= 0) {
			clearInterval(i);
      $("#timer").html('00:00');
			$("#progress-bar").css('width','100%');
			$("#btn-roll").attr('disabled', false);
		}
	}, 1000);
}