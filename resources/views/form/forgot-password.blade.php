<p>We will send a password reset link to your email.</p>
<form method="post" action="/forgot-password" id="form-forgot-password" role="form" class="text-start">
    @csrf

    <label class="form-label" for="f-email">Email:</label>
    <div class="input-group input-group-outline mb-3">
        <input id="f-email" name="email" type="email" class="form-control" autocomplete="off" required>
    </div>

	<button name="submit" type="submit" class="btn btn-primary w-100">Send reset link</button>
</form>