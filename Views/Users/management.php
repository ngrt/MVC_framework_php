  <div class="container">
  <div class="row col-md-6 col-md-offset-2 custyle">
  <table class="table table-striped custab">
  <thead>
    <tr>
      <th>#Id</th>
      <th>Username</th>
      <th>Email</th>
      <th>Group</th>
      <th>Status</th>

      <th class="text-center">Action</th>
    </tr>
  </thead>
  <?php
  	foreach($users as $key => $user)
  	{
  	 	echo "<tr>";
		echo "<td>" . $user['id'] . "</td>";
        echo "<td>" . $user['username'] . "</td>";
        echo "<td>" . $user['email'] . "</td>";
        echo "<td>" . $user['group_rush_string'] . "</td>";
        echo "<td>" . $user['status_string'] . "</td>";
        echo "<td class='text-center'><a class='btn btn-info btn-xs' href='" . WEBROOT . "users/edit/" . $user['id'] . "'><span class='glyphicon glyphicon-edit'></span> Edit</a> <a href='". WEBROOT . "users/delete/" . $user['id'] . "' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
      	echo "</tr>";
  	}
  ?>
  </table>
  </div>
</div>