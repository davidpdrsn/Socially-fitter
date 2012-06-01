<?php
  $page_name = "profile";
  include "inc/head.php";

  $user = new User();
  $user = $user->find_by_id($_GET["user_id"]);

  $logs = new Log();
  $logs = $logs->find_by_sql("SELECT log_id, title, body, notes, time FROM logs, users WHERE logs.user_id = users.user_id AND users.user_id = {$user->user_id} ORDER BY time ASC");


?>

<div id="profile" class="clearfix">
  <div class="profile-picture">
    <img src="images/profile-picture.jpg" alt="Profile Picture" />
  </div>
  <div class="profile-name">
    <h3><?php echo $user->username; ?></h3>
  </div>
  <div class="social-activity">
    <a href=""><span class="workouts"><?php echo $user->find_number_of_logs($user->user_id); ?></span>Workouts</a>
    <a href=""><span class="followers"><?php echo $user->find_number_of_followers($user->user_id); ?></span>Followers</a>
    <a href=""><span class="following"><?php echo $user->find_number_of_following($user->user_id); ?></span>Following</a>
  </div>
</div>

<div class="profile-follow clearfix">
  <?php if($session->user_id == $user->user_id): ?>
    <!-- this is you! -->
  <?php elseif($user->is_following($user->user_id, $session->user_id)): ?>
    <a href="unfollow.php?user_id=<?php echo $user->user_id; ?>" class="unfollow">Unfollow</a>
  <?php else: ?>
    <a href="follow.php?user_id=<?php echo $user->user_id; ?>" class="follow">Follow</a>
  <?php endif; ?>
</div>

<div id="profile-workouts">

<?php foreach($logs as $log): ?>
  <div class="log clearfix">
    <div class="log-header clearfix">
      <div class="log-time">
        <p><?php echo $log->time; ?></p>
      </div> <!-- .log-time -->
      <div class="profile-picture">
        <img src="http://placekitten.com/48/48/" alt="profile picture" class="picture" />
      </div> <!-- .profile-picture -->
      <div class="log-title">
        <p class="profile-name"><a href="profile.php?user_id=<?php echo $user->user_id; ?>"><?php echo $user->username ?></a></p>
        <p><?php echo $log->title; ?></p>
      </div> <!-- .log-title -->
    </div> <!-- .log-header -->
    <div class="log-footer">
      <span class="log-expand <?php if(isset($_GET["log_id_commented_on"]) && $_GET["log_id_commented_on"] == $log->log_id){ echo "open"; } ?>">Show more!</span>
      <div class="expanded-log">
        <div class="expanded-log-text clearfix">
          <?php echo $log->body; ?>
        </div> <!-- .expanded-log-text -->
        <?php
          $fav_url = "";
          $fav_text = "";
          if($log->is_faved()){
            $fav_url = "unfav.php?log_id={$log->log_id}&user_id{$user->user_id}";
            $fav_text = "Unfavorite";
          } else {
            $fav_url = "fav.php?log_id={$log->log_id}&user_id={$user->user_id}";
            $fav_text = "Favorite";
          }
        ?>
        <p class="log-favorite <?php if($log->is_faved()){ echo "faved"; } ?>"><a href="<?php echo $fav_url; ?>"><span class="glyph general">c</span> <?php echo $fav_text; ?></a></p>
        <p class="log-comment"><a href=""><span class="glyph social">w</span> Comment</a></p>
        <div class="commenting-log clearfix">
          <form action="comment.php" method="post">
            <input type="text" name="comment" placeholder="Wicked training bro!" id="writing-comment-log">
            <input type="hidden" name="log_id" value="<?php echo $log->log_id; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
            <input type="hidden" name="from_page" value="profile">
          </form>
          <div class="log-comments-list">
            <h4>Comments</h4>
            <?php
              $comments = new Comment();
              $comments = $comments->find_by_sql("SELECT comment.body, comment.time, comment.user_id, users.username FROM comment, users, logs WHERE logs.log_id = {$log->log_id} AND comment.log_id = logs.log_id AND users.user_id = comment.user_id");
              foreach($comments as $comment):
            ?>
            <div class="log-single-comment">
            <span class="comment-time"><?php echo $comment->time; ?></span><a href="profile.php?user_id=<?php echo $comment->user_id; ?>"><a href="profile.php?user_id=<?php echo $comment->user_id; ?>"><?php echo $comment->username; ?></a></a>
            <p><?php echo $comment->body; ?></p>
            </div> <!-- .log-single-comment -->
            <?php endforeach; ?>
          </div> <!-- .log-comments-lits -->
        </div> <!-- .commenting-log -->
      </div> <!-- .expanded-log -->
    </div> <!-- .log-footer -->
  </div> <!-- .log -->
<?php endforeach; ?>

</div> <!-- #profile-workouts -->

<?php include "inc/footer.php"; ?>
