@auth
<div class="text-center">
	<p>
		<i class="bx bx-lg bx-fade-right bx-mail-send text-primary ms-n2"></i>
	</p>
	<h3>Email sent!</h3>
	<p>
		An email verification link has been sent to <span class="fw-bold">{{$user->email}}</span><br/>
	</p>
	<form id="form-email-verification" action="/email/verification-notification" method="post">
		@csrf
		<button class="btn btn-primary mb-2" type="submit" disabled>Resend email</button>
	</form>
	<p class="text-secondary">
		Resend email in: <span id="countdown">00:00</span>
	</p>
</div>
@endauth