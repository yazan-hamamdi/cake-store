<?php
if (isset($_GET['result'])) {
    $result = $_GET['result'];
    echo "<script>alert('$result')</script>";
}
?>