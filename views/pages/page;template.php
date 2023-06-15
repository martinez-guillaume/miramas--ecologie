<?php 

ob_start();

?>

<h1 class="text-center">PAGE 1</h1>


<?php 

$content = ob_get_clean();
$title = "";
$css = "";

require "./views/base.php";
?>