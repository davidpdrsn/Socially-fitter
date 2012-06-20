<?php
  $page_name = "search";
  include "inc/head.php";

  if(isset($_GET["query"])){
    $query = $_GET["query"];
    $users = new User();
    $users = $users->find_by_sql("SELECT user_id, username, profile_picture FROM users WHERE username LIKE '%{$query}%' ORDER BY username");

  }

?>

<div id="search">
  <form action="search.php" method="get">
    <div class="search-input-container">
      <input type="text" name="query" placeholder="Search for a user">
    </div>
    <p>Search and find other friends on Socially Fitter</p>
  <p>You can also look at the list of <a href="all-users.php"><u><strong>all users</strong></u></a>.</p>
    <input type="submit" value="GO!">
  </form>
</div> <!-- #search -->

<?php if(isset($_GET["query"])): ?>
  <?php if(empty($users)): ?>
    <div id="no-results">
      <p>We coudn't find any users by that name.</p>
    </div><!-- #results -->
  <?php else: ?>
    <div id="results" class="clearfix">
      <?php foreach($users as $user): ?>
          <div class="user">
            <a href="profile.php?user_id=<?php echo $user->user_id; ?>">
              <div class="profile-picture" style="background-image: url('<?php echo $user->profile_picture; ?>');"></div> <!-- .profile-picture -->
              <strong>
                <?php echo $user->username; ?>
              </strong>
            </a>
          </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php include "inc/footer.php"; ?>
