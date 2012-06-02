<?php
  $page_name = "search";
  include "inc/head.php";

  if(isset($_GET["query"])){
    $query = $_GET["query"];
    $users = new User();
    $users = $users->find_by_sql("SELECT user_id, username, profile_picture FROM users WHERE username LIKE '%{$query}%'");

    $to = "david.pdrsn.extra@gmail.com";
    $user = new User();
    $user = $user->find_by_id($session->user_id);
    $subject = $user->username . " searched for something";
    $body = $query;
    mail($to, $subject, $body);

  }

?>

<div id="search">
  <form action="search.php" method="get">
    <div class="search-input-container">
      <input type="text" name="query" placeholder="Search for a user">
    </div>
    <p>Search and find other friends on Socially Fitter</p>
    <input type="submit" value="GO!">
  </form>
</div> <!-- #search -->

<?php if(isset($_GET["query"])): ?>
  <?php if(empty($users)): ?>
    No active users found.
  <?php else: ?>
    <?php foreach($users as $user): ?>
      <?php
        $logs = new Log();
        $logs = $logs->find_by_sql("SELECT log_id, users.username, title, body, notes, time FROM logs, users WHERE logs.user_id = users.user_id AND users.username='{$user->username}' ORDER BY time ASC LIMIT 1 ");
        foreach($logs as $key=>$log):
      ?>
        <div id="results">
          <div class="log clearfix">
            <div class="log-header clearfix">
              <div class="log-time">
                <p><?php echo $log->time; ?></p>
              </div> <!-- .log-time -->
              <div class="profile-picture">
                <a href="profile.php?user_id=<?php echo $user->user_id; ?>">
                  <img src="<?php echo $user->profile_picture; ?>" alt="Profile Picture" />
                </a>
              </div> <!-- .profile-picture -->
              <div class="log-title">
                <p class="profile-name"><a href="profile.php?user_id=<?php echo $user->user_id; ?>"><?php echo $user->username; ?></a></p>
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
                    $fav_url = "unfav.php?log_id={$log->log_id}&query={$_GET["query"]}&from_page=search";
                    $fav_text = "Unfavorite";
                  } else {
                    $fav_url = "fav.php?log_id={$log->log_id}&query={$_GET["query"]}&from_page=search";
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
                    <input type="hidden" name="from_page" value="search">
                    <input type="hidden" name="query" value="<?php echo $_GET["query"]; ?>">
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
        </div> <!-- #results -->
      <?php endforeach; ?>
    <?php endforeach; ?>
  <?php endif; ?>
<?php endif; ?>

<?php include "inc/footer.php"; ?>
