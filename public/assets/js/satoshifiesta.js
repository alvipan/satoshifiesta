let data = {
	audio: {},
	config: [],
	game: {},
	modal: {},
	page: {
		url: '',
		title:'',
		controller: ''
	},
	postRedirect: {
		'/login': '/faucet',
		'/register':'/email/verify',
		'/forgot-password': '/reset-password/sent',
		'/reset-password': '/reset-password/success'
	},
	script: [
		'faucet'
	],
	user: null,
};

$.when (
	$.get('/data/get', function(res) {
		data.config = res.config;
		data.user = res.user;
		if (!data.user) data.modal.connect = new bootstrap.Modal(document.getElementById('modal-connect'), {keyboard: false});
	})
).done(function() {
	data.page.url = location.pathname;
	data.page.controller = data.page.url.split('/')[1];

	window.onpopstate = function(e){
		if(e.state){
			$('#content').html(e.state.html);
			data.page.url = location.pathname;
			data.page.controller = data.page.url.split('/')[1];
			update_active_menu();
		}
	};

	get_content(false);
});

$('a').click(function(e) {
	e.preventDefault();
	data.page.url = $(this).attr('href');
	data.page.controller = data.page.url.split('/')[1];

	if (data.page.url != '/logout') {
		get_content();
	} else {
		location.href = data.page.url;
	}
});

$('form').submit(function(e) {
	e.preventDefault();
	let url = $(this).attr('action');
	let input = $(this).serialize();
	let button = $(this).find(`button[type='submit']`);
	let buttonText = button.text();
	let loaderIcon = `<i class='bx bx-loader-circle bx-spin'></i>`;

	button.addClass('disabled').html(loaderIcon);
	$.post(url, input, function(res) {
		if (res.success) {
			show_alert('alert-success', res.message);

			if (url in data.postRedirect) {
				location.href = data.postRedirect[url];
			}
		} else {
			show_alert('alert-danger', res.message);
			button.removeClass('disabled').html(buttonText);
		}
	}, `json`);
});

$('#content').bind("DOMSubtreeModified",function(){
	history.replaceState({'html':$('#content').html()}, '', data.page.url);
});

function get_content(push = true) {
	if (data.page.controller == '') {
		data.page.controller = 'welcome';
	}

	$.get(`${data.page.controller}/content`, function(res) {
		$('#content').html(res);
		if (push) {
			history.pushState({'html':res}, '', data.page.url);
		} else {
			history.replaceState({'html':res}, '', data.page.url);
		}
		update_active_menu();
	});
}

function showTab() {
	$('#forgot-password-tab').tab('show');
}

function update_active_menu() {
	$('aside .menu-inner li').removeClass('active open');
	$('aside .menu-inner')
		.find(`a[href='/${data.page.controller}']`)
		.parents('li')
		.addClass('active open');
	if (data.script.includes(data.page.controller)) {
		$.getScript(`/assets/js/page/${data.page.controller}.js`);
	}
}

function show_alert(type, message) {
	let content = `<div class="alert ${type} text-white">${message}</div>`;
	$('#alert').html($(content).fadeTo(3000, 1).toggle('slide'));
}