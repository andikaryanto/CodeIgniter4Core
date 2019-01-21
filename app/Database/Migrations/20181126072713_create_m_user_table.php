<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class Migration_create_m_user_table extends Migration {

    public function up() {
        $forge = \Config\Database::forge();
        $db = \Config\Database::connect();
        $forge->addField(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'M_Groupuser_Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ),
            'Username' => array(
                'type' => 'varchar',
                'constraint' => 100
            ),
            'Password' => array(
                'type' => 'varchar',
                'constraint' => 50
            ),
            'IsLoggedIn' => array(
                'type' => 'smallint',
                'constraint' => 11,
                'default' => 0
            ),
            'IsActive' => array(
                'type' => 'smallint',
                'constraint' => 11,
                'default' => 1
            ),
            'Language' => array(
                'type' => 'varchar',
                'constraint' => 50,
                'default' => 'indonesia'
            ),
            'CreatedBy' => array(
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true
            ),
            'ModifiedBy' => array(
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true
            ),
            'Created' => array(
                'type' => 'datetime',
                'null' => true
            ),
            'Modified' => array(
                'type' => 'datetime',
                'null' => true
            )
        ));
        
        $forge->addKey('Id', TRUE);
        $forge->createTable('m_users', TRUE);
        $db->query('ALTER TABLE `m_users` ADD CONSTRAINT `m_users_M_Groupuser_Id_fk` FOREIGN KEY (`M_Groupuser_Id`) REFERENCES `m_groupusers`(`Id`) ON DELETE RESTRICT ON UPDATE CASCADE');
    }

    public function down() {
        // $this->dbforge->drop_table('m_user');
    }

}