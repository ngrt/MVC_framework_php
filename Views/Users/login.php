<form method='post' action="#">
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
  </div>
  <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input" name="remember_me">
      Remember me
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<br>
<br>
<div>
    <a href="<?php echo WEBROOT . 'users/register'; ?>" class="btn btn-info">Or register if you don't have an account.</a>
</div>