<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class Migration_insert_defaul_table_user extends Migration {

    private $table = 'm_users';
    public function up() {
        $db = \Config\Database::connect();
        $data = [
            'Username' => 'superadmin',
            'Password' => '4586c6dc7de2fcdcf3a03f334cd2f7cb'
        ];
        
        $builder = $db->table('m_users');
        $builder->insert($data);

    }

    public function down() {
        //$this->dbforge->drop_table('insert_defaul_table_user');
    }

}