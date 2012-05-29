<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>Socially Fitter - Lets get fit together</title>
  <link rel="stylesheet" type="text/css" href="css/global.css">
  <link rel="stylesheet" type="text/css" href="css/logging.css">
</head>
<body>

  <div id="wrap">

      <div id="main-menu">
        <a href="timeline.html" class="timeline"><span class="glyph general">m</span></a>
        <a href="logging.html" class="logging"><span class="glyph general">[</span></a>
        <a href="profile.html" class="profil"><span class="glyph social">x</span></a>
        <a href="search.html" class="search"><span class="glyph general">=</span></a>
      </div> <!-- #main-menu -->

	    <div id="logging">
        <form action="share.html">
          <label for="workoutname"><strong>Workout name:</strong></label>
          <input type="text" name="workoutname" placeholder="Back">

          <p><strong>Exercises:</strong></p>
          <div class="exercises">
            <div class="exercise clearfix">
              <label for="exercise" data-number="1">#</label>
              <input type="text" name="exercise" placeholder="Name of exercise">
              <input type="text" name="reps" placeholder="Reps">
              <input type="text" name="weight" placeholder="Kg">
              <input type="text" name="sets" placeholder="Sets">
              <a href="#" class="remove">e</a>
            </div> <!-- .exercise -->
          </div> <!-- .exercises -->

          <a href="#" class="addmore">d</a>

          <label for="notes"><strong>Notes:</strong></label>
          <textarea name="notes" placeholder="Boy that was a tough one!"></textarea>

          <input type="submit" value="Done!">
        </form>
	    </div> <!-- #logging -->

  </div> <!-- #wrap -->

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/script.js"></script>

</body>
</html>