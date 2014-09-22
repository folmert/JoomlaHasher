<?php
define( '_JEXEC', 1 );
define('JPATH_BASE', "joomla" );
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();   
ini_set('default_charset', 'utf-8');


error_reporting(E_ALL ^ E_NOTICE);

$password=$_POST['input'];

jimport('joomla.user.helper');
$hashed = JUserHelper::hashPassword($password);


echo $hashed;



?>