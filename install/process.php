<?php

$text = '; This is a sample configuration file
; Comments start with \';\', as in php.ini

[first_section]
one = 1
five = 5
animal = BIRD

[second_section]
path = "/usr/local/bin"
URL = "http://www.example.com/~username"

[third_section]
phpversion[] = "5.0"
phpversion[] = "5.1"
phpversion[] = "5.2"
phpversion[] = "5.3"';

$f=fopen('config.ini', 'w+') or die("can't open file");
fwrite($f, $text);
fclose($f);
?>
