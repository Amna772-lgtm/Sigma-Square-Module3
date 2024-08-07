<?php
/**
 * execute during plugin deactivation
 */

class Wp_Forms_Deactivator
{
   public static function deactivate()
   {
      self::drop_custom_meta_table();
   }

   /**
    * Drop custom meta table for book details.
    */
   private static function drop_custom_meta_table()
   {
      global $wpdb;

      $table_name = $wpdb->prefix . 'register_users';

      $sql = "DROP TABLE IF EXISTS $table_name;";

      $wpdb->query($sql);
   }

}