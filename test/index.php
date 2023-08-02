<?php
require_once('../config/dbconfig.php');
require_once('../config/config.php');
require_once('../header.php');
?>

<form action="encrypt.php" method="post">
<input type="text" name="password"/><br/>
<textarea name="contents" cols="40" rows="8"></textarea><br/>
<input type="submit" value="전송"/><br/>
</form>

<?php
require_once('../footer.php');
?>