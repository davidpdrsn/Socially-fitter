<div id="main-menu">
  <?php if(!$session->is_logged_in()): ?>
    <form action="login.php" method="post">
      <input type="text" name="username" placeholder="Username" id="username">
      <input type="password" name="password" placeholder="Password" id="password">
      <input type="submit" name="submit" value="Login" id="login-button" class="login">
    </form>
  <?php else: ?>
    <a href="timeline.php" class="timeline"><span class="glyph general">m</span></a>
    <a href="logging.php" class="logging"><span class="glyph general">[</span></a>
    <a href="profile.php?user_id=<?php echo $session->user_id; ?>" class="profil"><span class="glyph social">x</span></a>
    <a href="search.php" class="search"><span class="glyph general">=</span></a>
  <?php endif; ?>
</div> <!-- #main-menu -->
