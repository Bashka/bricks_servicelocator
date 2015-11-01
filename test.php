<?php
namespace Bricks\ServiceLocator;
require_once('Manager.php');

$sl = new Manager;
$sl->factory('my', function($manager){
  echo 1;
  return 'Hello';
}, null, true);
echo $sl->get('my');
echo $sl->get('my');
