<?php
header("Expire-stuff: something");
echo file_get_contents($_GET['url']);