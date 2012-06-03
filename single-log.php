<?php
  $page_name = "single";
  include "inc/head.php";

  $log = new Log();
  $log = $log->find_by_id($_GET["log_id"]);
  $user = new User();
  $user = $user->find_by_id($log->user_id);

  $log->title = str_replace("\\", "", $log->title);
  $log->body = str_replace("\\", "", $log->body);
  $log->notes = str_replace("\\", "", $log->notes);

?>

<?php if($session->is_logged_in()): ?>
  <div id="profile-workouts">
    <div class="log clearfix">
      <div class="log-header clearfix">
        <div class="log-time">
          <p><?php echo $log->time; ?></p>
        </div> <!-- .log-time -->
        <div class="profile-picture">
          <img src="<?php echo $user->profile_picture; ?>" alt="Profile Picture" />
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
              $fav_url = "unfav.php?log_id={$log->log_id}&from_page=single-log";
              $fav_text = "Unfavorite";
            } else {
              $fav_url = "fav.php?log_id={$log->log_id}&from_page=single-log";
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
  </div> <!-- #profile-workouts -->
<?php else: // not logged in ?>
  <div id="profile-workouts">
    <div class="log clearfix">
      <div class="log-header clearfix">
        <div class="log-time">
          <p><?php echo $log->time; ?></p>
        </div> <!-- .log-time -->
        <div class="profile-picture">
          <img src="<?php echo $user->profile_picture; ?>" alt="Profile Picture" />
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
          <p class="log-favorite"><a href="#"><span class="glyph general">c</span> Favorites<?php echo " (" . $log->number_of_favs() . ")"; ?></a></p>
          <p class="log-comment"><a href=""><span class="glyph social">w</span> Comment (<?php echo $log->number_of_comments(); ?>)</a></p>
          <div class="commenting-log clearfix">
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
  </div> <!-- #profile-workouts -->
<?php endif; ?>


<?php include "inc/footer.php"; ?>
