<?php
  $page_name = "logging";
  include "inc/head.php";
?>

<div id="logging">
  <form action="log.php" method="post">
    <label for="workoutname"><strong>Workout name:</strong></label>
    <input type="text" name="title" placeholder="Back">

    <p><strong>Exercises:</strong></p>
    <div class="exercises">
      <div class="exercise clearfix">
        <label for="exercise" data-number="1">#</label>
        <input type="text" name="exercise1" placeholder="Name of exercise">
        <input type="number" class="reps" name="reps1" placeholder="Reps">
        <input type="number" class="weight" name="weight1" placeholder="Kg">
        <input type="number" class="sets" name="sets1" placeholder="Sets">
        <a href="#" class="remove"><img src="images/minus.png" alt="Minus"></a>
      </div> <!-- .exercise -->
    </div> <!-- .exercises -->

    <a href="#" class="addmore"><img src="images/plus.png" alt="Plus"></a>

    <label for="notes"><strong>Notes:</strong></label>
    <textarea name="notes" placeholder="Boy that was a tough one!"></textarea>

    <input type="submit" name="submit" value="Done!">
  </form>
</div> <!-- #logging -->

<?php include "inc/footer.php"; ?>
