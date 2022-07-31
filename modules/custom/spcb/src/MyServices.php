<?php
namespace  Drupal\spcb;

/**
* @file providing the service that return timezone date.
*
*/

class MyServices {

 public function get_currenttime()
 {
 	$config = \Drupal::getContainer()->get('config.factory')->getEditable('spcb.adminsettings');

 	$timezone_saved = $config->get('timezone');
 	date_default_timezone_set($timezone_saved);
 	return date('jS M Y - h:i A');
 	
 }
 
}