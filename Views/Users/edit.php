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

    <div class="form-group">
        <label for="group">Group:</label>
        <select class="form-control" id="group" name="group">
            <option value="1" <?php if($user[0]['group_rush'] == 1) echo "selected='selected'";?>>Reader</option>
            <option value="2" <?php if($user[0]['group_rush'] == 2) echo "selected='selected'";?>>Writer</option>
            <option value="3" <?php if($user[0]['group_rush'] == 3) echo "selected='selected'";?>>Admin</option>
        </select>
    </div>

    <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" id="status" name="status">
            <option value="0" <?php if($user[0]['status'] == 0) echo "selected='selected'";?>>Disactivated</option>
            <option value="1" <?php if($user[0]['status'] == 1) echo "selected='selected'";?>>Activated</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
