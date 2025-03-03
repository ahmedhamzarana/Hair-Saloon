<?php 

session_start();
session_unset();
session_destroy();
session_cache_expire();


echo "<script>window.location.href='index.php'</script>";

?>
