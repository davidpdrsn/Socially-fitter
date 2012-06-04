<?php
  $page_name = "allusers";
  include "inc/head.php";

  $user_id = $_GET["user_id"];

  $current_user = new User();
  $current_user = $current_user->find_by_id($user_id);

  $followings = new User();
  $followings = $followings->find_by_sql("SELECT user_id, username, profile_picture FROM users, follow WHERE users.user_id = follow.following_id AND follow.follower_id = {$user_id}");

?>

<div id="all-users" class="clearfix">
  <?php if(empty($followings)): ?>
    <h2><?php echo $current_user->username; ?> isn't following anyone</h2>
  <?php else: ?>
    <h2>People <?php echo $current_user->username; ?> is following</h2>
    <?php foreach($followings as $following): ?>
      <div class="user">
        <a href="profile.php?user_id=<?php echo $following->user_id; ?>">
          <div class="profile-picture" style="background-image: url('<?php echo $following->profile_picture; ?>');"></div>
          <strong>
            <?php echo $following->username; ?>
          </strong>
        </a>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php include "inc/footer.php"; ?>
