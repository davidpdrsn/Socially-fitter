<?php
  $page_name = "allusers";
  include "inc/head.php";

  $user_id = $_GET["user_id"];

  $current_user = new User();
  $current_user = $current_user->find_by_id($user_id);

  $followers = new User();
  $followers = $followers->find_by_sql("SELECT user_id, username, profile_picture FROM users, follow WHERE users.user_id = follow.follower_id AND follow.following_id = {$current_user->user_id}");

?>

<div id="all-users" class="clearfix">
  <?php if(empty($followers)): ?>
    <h2><?php echo $current_user->username; ?> has no followers</h2>
  <?php else: ?>
    <h2><?php echo $current_user->username; ?>'s followers</h2>
    <?php foreach($followers as $follower): ?>
      <div class="user">
        <a href="profile.php?user_id=<?php echo $follower->user_id; ?>">
          <div class="profile-picture" style="background-image: url('<?php echo $follower->profile_picture; ?>');"></div>
          <strong>
            <?php echo $follower->username; ?>
          </strong>
        </a>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php include "inc/footer.php"; ?>
