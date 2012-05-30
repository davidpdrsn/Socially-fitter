<?php
  $page_name = "profile";
  include "inc/head.php";
?>

<div id="profile" class="clearfix">
  <div class="profile-picture">
    <img src="http://www.placekitten.com/74/74/" alt="Profile Picture" />
  </div>
  <div class="profile-name">
    <h3>Træner Jørgen</h3>
  </div>
  <div class="social-activity">
    <a href=""><span class="workouts">13.921</span>Workouts</a>
    <a href=""><span class="followers">998.900</span>Followers</a>
    <a href=""><span class="following">22.600</span>Following</a>
  </div>
</div>

<div class="profile-follow clearfix">
  <a href="" class="follow">Follow</a>
  <!-- <a href="" class="unfollow">Unfollow</a> -->
</div>

<div id="profile-workouts">

  <div class="log clearfix">
    <div class="log-header clearfix">
      <div class="log-time">
        <p>15.02</p>
      </div> <!-- .log-time -->
      <div class="profile-picture">
        <img src="http://placekitten.com/48/48/" alt="profile picture" class="picture" />
      </div> <!-- .profile-picture -->
      <div class="log-title">
        <p class="profile-name">Navn</p>
        <p>Workout navn</p>
      </div> <!-- .log-title -->
    </div> <!-- .log-header -->
    <div class="log-footer">
      <span class="log-expand">Show more!</span>
      <div class="expanded-log">
        <div class="expanded-log-text clearfix">
          <strong>Brench press</strong>
          <p>8 reps, 95kg, 3 sets</p>
          <strong>Brench press</strong>
          <p>8 reps, 95kg, 3 sets</p>
          <strong>Brench press</strong>
          <p>8 reps, 95kg, 3 sets</p>
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

  <div class="log clearfix">
    <div class="log-header clearfix">
      <div class="log-time">
        <p>15.02</p>
      </div> <!-- .log-time -->
      <div class="profile-picture">
        <img src="http://placekitten.com/48/48/" alt="profile picture" class="picture" />
      </div> <!-- .profile-picture -->
      <div class="log-title">
        <p class="profile-name">Navn</p>
        <p>Workout navn</p>
      </div> <!-- .log-title -->
    </div> <!-- .log-header -->
    <div class="log-footer">
      <span class="log-expand">Show more!</span>
      <div class="expanded-log">
        <div class="expanded-log-text clearfix">
          <strong>Brench press</strong>
          <p>8 reps, 95kg, 3 sets</p>
          <strong>Brench press</strong>
          <p>8 reps, 95kg, 3 sets</p>
          <strong>Brench press</strong>
          <p>8 reps, 95kg, 3 sets</p>
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

</div> <!-- #profile-workouts -->

<?php include "inc/footer.php"; ?>
