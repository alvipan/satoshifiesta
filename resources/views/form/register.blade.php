<form action="/register" method="post"id="form-register" role="form" class="text-start">
	@csrf

	<label class="form-label" for="reg-name">Username:</label>
  <div class="input-group input-group-outline mb-3">
    <input id="reg-name" name="name" type="text" class="form-control" required/>
  </div>

  <label class="form-label" for="reg-email">Email:</label>
  <div class="input-group input-group-outline mb-3">
    <input id="reg-email" name="email" type="email" class="form-control" required/>
  </div>

  <label class="form-label" for="reg-password">Password:</label>
  <div class="input-group input-group-outline mb-3">
    <input id="reg-password" name="password" type="password" class="form-control" required/>
  </div>

  <div class="form-check form-check-secondary text-start">
    <input id="reg-age" name="age" class="form-check-input" type="checkbox" value="18" required/>
    <label class="form-check-label" for="reg-age">
      I confirm that I am 18 years old
    </label>
  </div>

  <div class="form-check form-check-secondary text-start mb-3">
    <input id="reg-terms" name="terms" class="form-check-input" type="checkbox" value="agree" required/>
    <label class="form-check-label" for="reg-terms">
      I agree the <a href="/terms" class="text-dark font-weight-bolder">Terms of Service</a>
    </label>
  </div>

  <button class="btn btn-primary w-100" name="submit" type="submit">Register</button>
</form> 