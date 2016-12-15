<?php

//SECTION CONTENT START
ob_start();
?>
<?php
//SECTION CONTENT END
$content = ob_get_contents();
ob_end_clean();

//Include template
include (ROOT_DIR.'templates/maintemplate.php');
