<?php
require('./make_sql.php');

$make_update = new MakeSql;
$sql = $make_update->main();
file_put_contents('../sql/result.sql', $sql);
