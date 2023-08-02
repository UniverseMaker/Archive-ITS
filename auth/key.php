<?php
require_once('../header.php');
?>

<p>Key Management System</p>
<p>It will be generate RSA 4096bit-sha512 key pair.</p>
<p>&nbsp;</p>
<p>Warning! If you execute this command it will be reset your previous key pair.</p>
<p>&nbsp;</p>

<form action="keyset.php" method="post">
<label for="password">Key Pair Password </label>
<input type="password" name="password" value="" required="required"/>
<input type="submit" value="실행"/>
</form>

<?php
require_once('../footer.php');
?>