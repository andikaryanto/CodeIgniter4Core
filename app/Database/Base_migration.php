<?php namespace App\Database;
use CodeIgniter\Database\Migration;
class Base_migration extends Migration {
    public function up() {}
    public function down() {}
    public function db(){
        return \Config\Database::connect();
    }

    public function forge(){
        return \Config\Database::forge();
    }

    public function addForeignKey($table, $foreign_key, $references, $on_delete = 'RESTRICT', $on_update = 'CASCADE'){
        $references = explode('(', str_replace(')', '', str_replace('`', '', $references)));
        $query = "ALTER TABLE `{$table}` ADD CONSTRAINT `{$table}_{$foreign_key}_fk` FOREIGN KEY (`{$foreign_key}`) REFERENCES `{$references[0]}`(`{$references[1]}`) ON DELETE {$on_delete} ON UPDATE {$on_update}";
        $this->db()->query($query);
    }
}