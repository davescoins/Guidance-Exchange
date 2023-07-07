<?php
$query = $_POST['query'];




header("Location: search.php?query=" . $query);
exit();
