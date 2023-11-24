<form method="post" action="/auth/login" id="form-login" role="form" class="text-start">
    @csrf

    <label class="form-label" for="email">Email:</label>
    <div class="input-group input-group-outline mb-3">
        <input id="email" name="email" type="email" class="form-control" autocomplete="off" required>
    </div>

    <label class="form-label" for="password">Password:</label>
    <div class="input-group input-group-outline mb-3">
        <input id="password" name="password" type="password" class="form-control" autocomplete="off" required>
    </div>

    <p class="text-sm mb-0">
        <a class="text-info text-gradient" data-bs-toggle="modal" href="#reset-password">Forgot your password?</a>
    </p>

    <button
        name="submit"
        type="submit"
        class="h-captcha btn btn-primary w-100 mt-3 mb-4"
        data-sitekey="3a5c43c7-7114-4d08-8be1-3e70e1fb1233"
        data-callback="login">Login</button>

    <p class="text-sm">
        By accessing the site, I confirm that I have read and agree the
        <a class="text-info text-gradient font-weight-bold" href="/terms">Terms of Service</a>
    </p>
</form>