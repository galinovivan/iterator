<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 04.05.2017
 * Time: 10:33
 */

require ('classes/FileIterator.php');

use project\classes\FileIterator;
$path = 'exp.txt';
$file = new FileIterator($path, 1, 'r');
//$current = $file->current();
echo $file->testMode();


