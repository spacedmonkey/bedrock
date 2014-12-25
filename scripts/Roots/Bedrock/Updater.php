<?php

namespace Roots\Bedrock;

use Composer\Script\Event;

class Updater {
  public static $KEYS = array(
    'WP_CACHE_KEY_SALT',
    'WP_SITE_VERSION'
  );

  public static function updateKeys(Event $event) {
    $root = dirname(dirname(dirname(__DIR__)));
    $composer = $event->getComposer();
    $io = $event->getIO();
    
    $generate_salts = $composer->getConfig()->get('update-cache-keys');
    
    if (!$generate_salts) {
      return 1;
    }



    $env_file = "{$root}/.env";

    if( ! file_exists( $env_file ) ){
       $io->write("<error>An error occured while writing .env file as it doesn't exist</error>");
       return 1;
    }else{
       $data = file_get_contents( $env_file );
       
       foreach( self::$KEYS as $key ){
          $pattern = "/".$key."='(.*?)'/i";
          
          preg_match_all($pattern, $data, $matches);
          
          $current_keys = $matches[1];
          $data = str_replace($current_keys,Updater::generateSalt(), $data);
       }
       file_put_contents( $env_file, $data );
       $io->write("<info>Cache keys updated</info>");
       return 1;
    }
     
    
  }

  /**
   * Slightly modified/simpler version of wp_generate_password
   * https://github.com/WordPress/WordPress/blob/cd8cedc40d768e9e1d5a5f5a08f1bd677c804cb9/wp-includes/pluggable.php#L1575
   */
  public static function generateSalt($length = 64) {
    $chars  = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $chars .= '!@#$%^&*()';
    $chars .= '-_ []{}<>~`+=,.;:/?|';

    $salt = '';
    for ($i = 0; $i < $length; $i++) {
      $salt .= substr($chars, rand(0, strlen($chars) - 1), 1);
    }

    return $salt;
  }
}
