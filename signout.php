<?php
  // session start
  session_start();
  // session destory
  session_destroy();
  // route to sigin page
  header("Location:  signin.php");
?>