<?php
/**
 * execute during plugin activation
 */

class Wp_Forms_Activator
{
   public static function activate()
   {
      self::wp_forms_create_table();
   }

   /**
    * create custom table for storing data of registered users
    */
   private static function wp_forms_create_table()
   {
      global $wpdb;
      $table_name = $wpdb->prefix . 'register_users'; 
      $charset_collate = $wpdb->get_charset_collate();

      $sql = "CREATE TABLE $table_name (
       id mediumint(9) NOT NULL AUTO_INCREMENT,
       name varchar(255) NOT NULL,
       email varchar(255) NOT NULL UNIQUE,
       password varchar(255) NOT NULL,
       reg_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
       PRIMARY KEY (id)
   ) $charset_collate;";

      require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);
   }

}