let data = {};

$.when (
	$.get('/data/get', function(res) {
		data = res;
	}),
	update_active_menu()
).done(function() {
	
});

history.pushState({"html":$('#content').html()}, '', location.pathname);
window.onpopstate = function(e){
	if(e.state){
			$('#content').html(e.state.html);
			update_active_menu();
	}
};

$('aside .menu-inner a').click(function(e) {
	e.preventDefault();
	let url = $(this).attr('href');
	$.get(`${url}/content`, function(res) {
		$('#content').html(res);
		history.pushState({"html":res}, '', url);
		update_active_menu();
	});
});

function login(token) {
	let form = $('#form-login');
	let input = form.serialize();
	let button = form.find("[name='submit']");
	button.addClass("disabled");

	$.post('/login', input, function(res) {
		if (res.success) {
			show_alert('alert-success', res.message);
			location.href = '/faucet';
		} else {
			show_alert('alert-danger', res.message);
			button.removeClass('disabled');
		}
	}, 'json');
}

function update_active_menu() {
	let path = location.pathname.split('/');
	let controller = path[1];
	$('aside .menu-inner li').removeClass('active open');
	$('aside .menu-inner')
		.find(`a[href='/${controller}']`)
		.parents('li')
		.addClass('active open');
	$.getScript(`/assets/js/page/${controller}.js`);
}

function show_alert(type, message) {
	let content = '<div class="alert ' + type + ' text-sm text-white" style="min-width:250px;">' + message + '</div>';
	$('#alert').html($(content).fadeTo(3000, 1).toggle('slide'));
}