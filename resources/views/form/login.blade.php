<form method="post" action="/login" id="form-login" role="form" class="text-start">
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
        <a class="text-info text-gradient" href="#" onclick="showTab()">Forgot your password?</a>
    </p>

    <button name="submit" type="submit" class="btn btn-primary w-100 mt-3 mb-4">Login</button>

    <p class="text-sm">
        By accessing the site, I confirm that I have read and agree the
        <a class="text-info text-gradient font-weight-bold" href="/terms">Terms of Service</a>
    </p>
</form>