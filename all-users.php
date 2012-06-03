<?php
  $page_name = "allusers";
  include "inc/head.php";

  $users = new User();
  $users = $users->find_by_sql("SELECT * FROM users ORDER BY username");
?>

<div id="all-users" class="clearfix">
  <h2>All users</h2>
  <?php foreach($users as $user): ?>
    <div class="user">
      <div class="profile-picture" style="background-image: url('<?php echo $user->profile_picture; ?>');"></div> <!-- .profile-picture -->
      <strong>
        <?php echo $user->username; ?>
      </strong>
    </div>
  <?php endforeach; ?>
</div>

<?php include "inc/footer.php"; ?>
