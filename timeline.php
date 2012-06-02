<?php
  $page_name = "timeline";
  include "inc/head.php";

  $followings = new User();
  $followings = $followings->find_by_sql("SELECT user_id FROM users, follow WHERE users.user_id = follow.following_id AND follow.follower_id = {$session->user_id}");


  $user = new User();
  $user = $user->find_by_id($session->user_id);
  if(!$user->has_followers() && $user->has_following()){
    $logs = new Log();
    $sql = "";
    $sql .= "SELECT logs.user_id, users.username, users.profile_picture, log_id, title, body, notes, time ";
    $sql .= "FROM users, follow, logs ";
    $sql .= "WHERE (users.user_id = follow.following_id OR users.user_id = follow.follower_id) ";
    $sql .= "AND (";
    foreach($followings as $following){
      $sql .= "users.user_id = ";
      $sql .= $following->user_id . " OR ";
    }
    $sql .= "users.user_id = ";
    $sql .= $session->user_id . " ";
    $sql .= ") ";
    $sql .= "AND users.user_id = logs.user_id ";
    $sql .= "ORDER BY log_id DESC";
    $logs = $logs->find_by_sql($sql);
  } elseif($user->has_followers() && $user->has_following()){
    $logs = new Log();
    $sql = "";
    $sql .= "SELECT logs.user_id, users.username, users.profile_picture, log_id, title, body, notes, time ";
    $sql .= "FROM users, follow, logs ";
    $sql .= "WHERE users.user_id = follow.following_id ";
    $sql .= "AND (";
    foreach($followings as $following){
      $sql .= "users.user_id = ";
      $sql .= $following->user_id . " OR ";
    }
    $sql .= "users.user_id = ";
    $sql .= $session->user_id . " ";
    $sql .= ") ";
    $sql .= "AND users.user_id = logs.user_id ";
    $sql .= "ORDER BY log_id DESC";
    $logs = $logs->find_by_sql($sql);
  } else {
    $logs = new Log();
    $logs = $logs->find_by_sql("SELECT log_id, title, body, notes, time, logs.user_id, users.username, users.profile_picture FROM logs, users WHERE users.user_id = {$session->user_id} AND logs.user_id = users.user_id");
  }

?>

<?php if(empty($logs)): ?>
  
  <div id="empty-timeline">
    
    <h2>Your timeline is empty</h2>
    
    <p>You aren't following anyone.</p>
    <p>And you haven't logged any trainings!</h3>
    <p>Don't you think it's a good idea to get started!?</p>
    <br />
    <p>To start using Socially Fitter, you can search for people to follow in the <span class="glyph general">=</span> menu. Or you can log a training in the <span class="glyph general">[</span> menu.</p>
    <br />
    <p>...</p>
    <p>Well, what are you waiting for?</p>
    
  </div> <!-- #empty-timeline -->
<?php else: ?>
  <div id="timeline">
    <?php foreach($logs as $log): ?>
      <div class="log clearfix">
        <div class="log-header clearfix">
          <div class="log-time">
            <p><?php echo $log->time; ?></p>
          </div> <!-- .log-time -->
          <a href="profile.php?user_id=<?php echo $log->user_id; ?>">
            <div class="profile-picture" style="background-image: url('<?php echo $user->profile_picture; ?>');"></div> <!-- .profile-picture -->
          </a>
          <div class="log-title">
            <p class="profile-name"><a href="profile.php?user_id=<?php echo $log->user_id; ?>"><?php echo $log->username; ?></a></p>
            <p><?php echo $log->title; ?></p>
          </div> <!-- .log-title -->
        </div> <!-- .log-header -->
        <div class="log-footer">
          <span class="log-expand <?php if(isset($_GET["log_id_commented_on"]) && $_GET["log_id_commented_on"] == $log->log_id){ echo "open"; } ?>">Show more!</span>
          <div class="expanded-log">
          <div class="expanded-log-text clearfix"><?php echo $log->body; ?></div> <!-- .expanded-log-text -->
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
                <input type="text" name="comment" placeholder="Wicked training bro!" id="writing-comment-log">
                <input type="hidden" name="log_id" value="<?php echo $log->log_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                <input type="hidden" name="from_page" value="timeline">
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
                  <?php foreach($comments as $comment): ?>
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
  </div> <!-- #timleine -->
<?php endif; ?>


<?php include "inc/footer.php"; ?>
