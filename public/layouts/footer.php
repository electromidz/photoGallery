</div>
<div id="footer">Copyright <?php echo date("Y", time()); ?>, Amir Azimi</div>
</body>
</html>
<?php if (isset($database)) {
      $database->close_connection();
  } ?>