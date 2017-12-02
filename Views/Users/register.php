<form method='post' action='#'>

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
      <?php if (isset($this->verifyRegisterForm($_POST)["username"])) echo $this->verifyRegisterForm($_POST)["username"];?>
  </div>

    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
        <?php if (isset($this->verifyRegisterForm($_POST)["email"])) echo $this->verifyRegisterForm($_POST)["email"];?>
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input  type="password" class="form-control" id="password" placeholder="Enter your password" name="password" >
      <?php  if (isset($this->verifyRegisterForm($_POST)["password"])) echo $this->verifyRegisterForm($_POST)["password"]; ?>
  </div>

  <div class="form-group">
    <label for="password-confirmation">Password Confirmation</label>
    <input type="password" class="form-control" id="password-confirmation" placeholder="Enter the same password" name="password-confirmation">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>