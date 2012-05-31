<?php
  $page_name = "profile";
  include "inc/head.php";

  $user = new User();
  $user = $user->find_by_id($_GET["user_id"]);

  $logs = new Log();
  $logs = $logs->find_by_sql("SELECT title, body, notes, time FROM logs, users WHERE logs.user_id = users.user_id AND users.user_id = {$user->user_id} ORDER BY time DESC");

?>

<div id="profile" class="clearfix">
  <div class="profile-picture">
    <img src="http://www.placekitten.com/74/74/" alt="Profile Picture" />
  </div>
  <div class="profile-name">
  <h3><?= $user->username; ?></h3>
  </div>
  <div class="social-activity">
    <a href=""><span class="workouts"><?= $user->find_number_of_logs($user->user_id); ?></span>Workouts</a>
    <a href=""><span class="followers"><?= $user->find_number_of_followers($user->user_id); ?></span>Followers</a>
    <a href=""><span class="following"><?= $user->find_number_of_following($user->user_id); ?></span>Following</a>
  </div>
</div>

<div class="profile-follow clearfix">
  <?php if($session->user_id == $user->user_id): ?>
    <a href="" class="follow">This is you!</a>
  <?php elseif($user->is_following($user->user_id, $session->user_id)): ?>
    <a href="unfollow.php?user_id=<?= $user->user_id; ?>" class="unfollow">Unfollow</a>
  <?php else: ?>
    <a href="follow.php?user_id=<?= $user->user_id; ?>" class="follow">Follow</a>
  <?php endif; ?>
</div>

<div id="profile-workouts">

<?php foreach($logs as $log): ?>
  <div class="log clearfix">
    <div class="log-header clearfix">
      <div class="log-time">
        <p><?= $log->time; ?></p>
      </div> <!-- .log-time -->
      <div class="profile-picture">
        <img src="http://placekitten.com/48/48/" alt="profile picture" class="picture" />
      </div> <!-- .profile-picture -->
      <div class="log-title">
        <p class="profile-name"><a href="profile.php?user_id=<?= $user->user_id; ?>"><?= $user->username ?></a></p>
        <p><?= $log->title; ?></p>
      </div> <!-- .log-title -->
    </div> <!-- .log-header -->
    <div class="log-footer">
      <span class="log-expand">Show more!</span>
      <div class="expanded-log">
        <div class="expanded-log-text clearfix">
          <?= $log->body; ?>
        </div> <!-- .expanded-log-text -->
        <p class="log-favorite"><a href=""><span class="glyph general">c</span> Favorite</a></p>
        <p class="log-comment"><a href=""><span class="glyph social">w</span> Comment</a></p>
        <div class="commenting-log clearfix">
          <form action="">
            <input type="text" name="writing-comment-log" placeholder="Wicked training bro!" id="writing-comment-log">
          </form>
          <div class="log-comments-list">
            <h4>Comments</h4>
            <div class="log-single-comment">
              <span class="comment-time">16.04</span><strong>Træner Jørgen</strong>
              <p>Det må jeg nok sige. Du har løftet vægte jo!</p>
            </div> <!-- .log-single-comment -->
            <div class="log-single-comment">
              <strong>Gurli Fit</strong><span class="comment-time">16.04</span>
              <p>Vis mig din mund.</p>
            </div> <!-- .log-single-comment -->
          </div> <!-- .log-comments-lits -->
        </div> <!-- .commenting-log -->
      </div> <!-- .expanded-log -->
    </div> <!-- .log-footer -->
  </div> <!-- .log -->
<?php endforeach; ?>

</div> <!-- #profile-workouts -->

<?php include "inc/footer.php"; ?>
