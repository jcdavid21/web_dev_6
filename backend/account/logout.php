<?php 
session_start();
session_destroy();
?>

<script>
    localStorage.removeItem("userDetails");
    window.location.href = "../../index.php";
</script>