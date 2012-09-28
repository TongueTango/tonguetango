<?php
header("Content-type: text/html; charset=utf8;");
$link = $_REQUEST["raw"];
print "Raw HTTP Output:<PRE>";

$output = system("curl '$link'", 1);
print $output;


print "</PRE>";