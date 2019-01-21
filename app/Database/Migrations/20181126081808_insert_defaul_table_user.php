<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class Migration_insert_defaul_table_user extends Migration {

    private $table = 'm_users';
    public function up() {
        $db = \Config\Database::connect();
        $data = [
            'Username' => 'superadmin',
            'Password' => '0d403ffb03c72dff96ee1d0de8c75ee8'
        ];
        
        $builder = $db->table('m_users');
        $builder->insert($data);

    }

    public function down() {
        //$this->dbforge->drop_table('insert_defaul_table_user');
    }

}