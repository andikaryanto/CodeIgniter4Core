<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
use App\Database\Base_migration;
class Migration_create_m_accessrole_table extends Base_migration {

    public function up() {
        $forge = $this->forge();
        $db = $this->db();
        $forge->addField(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'M_Form_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'M_Groupuser_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'Read' => array(
                'type' => 'TINYINT',
                'constraint' => 1
            ),
            'Write' => array(
                'type' => 'TINYINT',
                'constraint' => 1
            ),
            'Delete' => array(
                'type' => 'TINYINT',
                'constraint' => 1
            ),
            'Print' => array(
                'type' => 'TINYINT',
                'constraint' => 1
            ),
        ));
        $forge->addKey('Id', TRUE);
        $forge->createTable('m_accessroles', TRUE);
        $this->addForeignKey('m_accessroles', 'M_Groupuser_Id', 'm_groupusers(Id)', 'CASCADE');
        $this->addForeignKey('m_accessroles', 'M_Form_Id', 'm_forms(Id)');
          
    }

    public function down() {
        // $forge->drop_table('m_accessrole');
    }

}