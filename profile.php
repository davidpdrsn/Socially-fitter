<?php
  $page_name = "profile";
  include "inc/head.php";

  $user = new User();
  $user = $user->find_by_id($_GET["user_id"]);

  $logs = new Log();
  $logs = $logs->find_by_sql("SELECT log_id, title, body, notes, time FROM logs, users WHERE logs.user_id = users.user_id AND users.user_id = {$user->user_id} ORDER BY log_id DESC");
?>

<div id="profile" class="clearfix">
  <?php if($user->user_id == $session->user_id): ?>
    <a href="upload-picture.php">
      <div class="profile-picture" style="background-image: url('<?php echo $user->profile_picture; ?>');"></div>
    </a>
  <?php else: ?>
    <div class="profile-picture" style="background-image: url('<?php echo $user->profile_picture; ?>');"></div>
  <?php endif; ?>
  <div class="profile-name">
    <h3><?php echo $user->username; ?></h3>
  </div>
  <div class="social-activity">
    <p><span class="workouts"><?php echo $user->find_number_of_logs($user->user_id); ?></span>Workouts</p>
    <p><span class="followers"><?php echo $user->find_number_of_followers($user->user_id); ?></span>Followers</p>
    <p><span class="following"><?php echo $user->find_number_of_following($user->user_id); ?></span>Following</p>
  </div>
</div>

<div class="profile-follow clearfix">
  <?php if($session->user_id == $user->user_id): ?>
    <?php if($user->profile_picture == "/uploads/default.png"): ?>
      <p>You can change your profile picture by clicking on it!</p>
    <?php endif; ?>
  <?php elseif($user->is_following($user->user_id, $session->user_id)): ?>
    <a href="unfollow.php?user_id=<?php echo $user->user_id; ?>" class="unfollow">Unfollow</a>
  <?php else: ?>
    <a href="follow.php?user_id=<?php echo $user->user_id; ?>" class="follow">Follow</a>
  <?php endif; ?>
</div>

<?php if(empty($logs)): ?>
  <div id="no-profile-workouts">
    <p>Sadly, <?php echo $user->username; ?> hasn't logged any workouts yet.</p>
  </div><!-- #profile-workouts -->
<?php else: ?>
  <div id="profile-workouts">
    <?php
      foreach($logs as $log):
      $log->title = str_replace("\\", "", $log->title);
      $log->body = str_replace("\\", "", $log->body);
      $log->notes = str_replace("\\", "", $log->notes);
    ?>
      <div class="log clearfix">
        <div class="log-header clearfix">
          <div class="log-time">
            <p><?php echo $log->time; ?></p>
          </div> <!-- .log-time -->
          <div class="profile-picture" style="background-image: url('<?php echo $user->profile_picture; ?>');">
          </div> <!-- .profile-picture -->
          <div class="log-title">
            <p class="profile-name"><?php echo $user->username; ?></p>
            <p><?php echo $log->title; ?></p>
          </div> <!-- .log-title -->
        </div> <!-- .log-header -->
        <div class="log-footer">
          <span class="log-expand <?php if(isset($_GET["log_id_commented_on"]) && $_GET["log_id_commented_on"] == $log->log_id){ echo "open"; } ?>">Show more!</span>
          <div class="expanded-log">
            <div class="expanded-log-text clearfix">
              <?php echo $log->body; ?>
            </div> <!-- .expanded-log-text -->
            <?php if(strlen($log->notes) > 1): ?>
              <div class="expanded-log-text clearfix">
                <strong>Notes</strong>
                <p>
                  <?php echo $log->notes; ?>
                </p>
              </div> <!-- .expanded-log-text -->
            <?php endif; ?>
            <?php
              $fav_url = "";
              $fav_text = "";
              if($log->is_faved()){
                $fav_url = "unfav.php?log_id={$log->log_id}&from_page=timeline";
                $fav_text = "Unfavorite";
              } else {
                $fav_url = "fav.php?log_id={$log->log_id}&from_page=timeline";
                $fav_text = "Favorite";
              }
            ?>
            <p class="log-favorite <?php if($log->is_faved()){ echo "faved"; } ?>"><a href="<?php echo $fav_url; ?>"><span class="glyph general">c</span> <?php echo $fav_text . " (" . $log->number_of_favs() . ")"; ?></a></p>
            <p class="log-comment"><a href=""><span class="glyph social">w</span> Comment (<?php echo $log->number_of_comments(); ?>)</a></p>
            <div class="commenting-log clearfix">
              <form action="comment.php" method="post">
                <input type="text" name="comment" placeholder="Write you comment here" id="writing-comment-log">
                <input type="hidden" name="log_id" value="<?php echo $log->log_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                <input type="hidden" name="from_page" value="profile">
              </form>
              <div class="log-comments-list">
                <?php
                  $comments = new Comment();
                  $comments = $comments->find_by_sql("SELECT comment.body, comment.time, comment.user_id, users.username FROM comment, users, logs WHERE logs.log_id = {$log->log_id} AND comment.log_id = logs.log_id AND users.user_id = comment.user_id");
                ?>
                <?php if(empty($comments)): ?>
                  Nothing to see here.
                <?php else: ?>
                  <h4>Comments</h4>
                  <?php
                    foreach($comments as $comment):
                    $comment->body = str_replace("\\", "", $comment->body);
                  ?>
                  <div class="log-single-comment">
                  <span class="comment-time"><?php echo $comment->time; ?></span><a href="profile.php?user_id=<?php echo $comment->user_id; ?>"><a href="profile.php?user_id=<?php echo $comment->user_id; ?>"><?php echo $comment->username; ?></a></a>
                  <p><?php echo $comment->body; ?></p>
                  </div> <!-- .log-single-comment -->
                  <?php endforeach; ?>
                <?php endif; ?>
              </div> <!-- .log-comments-lits -->
            </div> <!-- .commenting-log -->
          </div> <!-- .expanded-log -->
        </div> <!-- .log-footer -->
      </div> <!-- .log -->
    <?php endforeach; ?>
  </div> <!-- #profile-workouts -->
<?php endif; ?>

<?php include "inc/footer.php"; ?>
