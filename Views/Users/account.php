<h1>Modify account</h1>
<form method='post' action='#'>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user[0]['username']; ?>">
        <?php echo isset($errors["username"]) ? $errors["username"] : null; ?>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control disabled" id="email" placeholder="Enter your email" name="email" value="<?php echo $user[0]['email']; ?>" disabled>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<h1>Modify password</h1>
<form method='post' action='#'>
    <div class="form-group">
        <label for="password">Password</label>
        <input  type="password" class="form-control" id="password" placeholder="Enter your password" name="password" >
        <?php echo isset($errors["password"]) ? $errors["password"] : null; ?>
    </div>

    <div class="form-group">
        <label for="password-confirmation">Password Confirmation</label>
        <input type="password" class="form-control" id="password-confirmation" placeholder="Enter the same password" name="password-confirmation">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<form action="#" method="post">
    <button type="submit" class="btn btn-danger" name="delete">Delete my account</button>
</form>

