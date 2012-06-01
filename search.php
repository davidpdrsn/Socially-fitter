<?php
  $page_name = "search";
  include "inc/head.php";

  if(isset($_GET["query"])){
    $query = $_GET["query"];
    $users = new User();
    $users = $users->find_by_sql("SELECT user_id, username FROM users WHERE username LIKE '%{$query}%'");

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
  <?php foreach($users as $user): ?>
    <?php
      $logs = new Log();
      $logs = $logs->find_by_sql("SELECT username, title, body, notes, time FROM logs, users WHERE logs.user_id = users.user_id AND users.username='{$user->username}' ORDER BY time ASC LIMIT 1 ");
      foreach($logs as $key=>$log):
    ?>
      <div id="results">
        <div class="log clearfix">
          <div class="log-header clearfix">
            <div class="log-time">
              <p><?= $log->time; ?></p>
            </div> <!-- .log-time -->
            <div class="profile-picture">
              <img src="http://placekitten.com/48/48/" alt="profile picture" class="picture" />
            </div> <!-- .profile-picture -->
            <div class="log-title">
              <p class="profile-name"><a href="profile.php?user_id=<?= $user->user_id; ?>"><?= $user->username; ?></a></p>
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
      </div> <!-- #results -->
    <?php endforeach; ?>
  <?php endforeach; ?>
<?php endif; ?>

<?php include "inc/footer.php"; ?>
