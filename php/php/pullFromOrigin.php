<?php

// Use ls command to shell_exec
// function

$output = shell_exec('git pull');
#$output = shell_exec("git branch -a");
// Display the list of all file
// and directory
echo "<pre>$output</pre>";

?>