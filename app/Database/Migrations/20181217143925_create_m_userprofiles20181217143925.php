<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
use App\Database\Base_migration;
class Migration_create_m_userprofiles20181217143925 extends Base_Migration {

    public function up() {
        $forge = $this->forge();
        $db = $this->db();
        $forge->addField(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'M_User_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'CompleteName' => array(
                'type' => 'Varchar',
                'constraint' => 300,
                'null' => true
            ),
            'Address' => array(
                'type' => 'Varchar',
                'constraint' => 300,
                'null' => true
            ),
            'Phone'  => array(
                'type' => 'Varchar',
                'constraint' => 20,
                'null' => true
            ),
            'Email'  => array(
                'type' => 'Varchar',
                'constraint' => 20,
                'null' => true
            ),
            'PhotoPath' => array(
                'type' => 'Varchar',
                'constraint' => 300,
                'null' => true
            ),
            'PhotoName'  => array(
                'type' => 'Varchar',
                'constraint' => 300,
                'null' => true
            ),
            'AboutMe'  => array(
                'type' => 'Varchar',
                'constraint' => 1000,
                'null' => true
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
        $forge->createTable('m_userprofiles', true);
        $this->addForeignKey('m_userprofiles', 'M_User_Id', 'm_users(Id)', 'CASCADE');
    }

    public function down() {
        //$forge->drop_table('create_m_userprofiles20190116143925');
    }

}