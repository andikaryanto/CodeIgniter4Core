<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class Migration_create_m_group_user_table extends Migration {

    public function up() {
        $forge = \Config\Database::forge();
        $forge->addField([
            'Id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'GroupName' => [
                'type' => 'varchar',
                'constraint' => 100
            ],
            'Description' => [
                'type' => 'varchar',
                'constraint' => 300
            ],
            'Deleted' => [
                'type' => 'SMALLINT',
                'constraint' => 11
            ],
            'CreatedBy' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true
            ],
            'ModifiedBy' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true
            ],
            'Created' => [
                'type' => 'datetime',
                'null' => true
            ],
            'Modified' => [
                'type' => 'datetime',
                'null' => true
            ]
        ]);
        $forge->addKey('Id', TRUE);
        $forge->createTable('m_groupusers', TRUE);
        
    }

    public function down() {
        // $this->dbforge->drop_table('m_groupuser');
    }

}
