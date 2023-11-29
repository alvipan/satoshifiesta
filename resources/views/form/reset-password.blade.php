<form id="form-reset-password" action="/reset-password" method="post" role="form" class="text-start">
	@csrf

	<input type="hidden" name="token" value="{{$token}}"/>

  <label class="form-label" for="f-email">Email:</label>
  <div class="input-group input-group-outline mb-3">
    <input id="f-email" name="email" type="email" class="form-control" autocomplete="off" required/>
  </div>

  <label class="form-label" for="f-password">Password:</label>
  <div class="input-group input-group-outline mb-3">
    <input id="f-password" name="password" type="password" class="form-control" autocompllete="off" required/>
  </div>

	<label class="form-label" for="f-password-confirmation">Password:</label>
  <div class="input-group input-group-outline mb-3">
    <input id="f-password-confirmation" name="password_confirmation" type="password" class="form-control" autocompllete="off" required/>
  </div>

  <button class="btn btn-primary w-100" name="submit" type="submit">Reset password</button>
</form> 