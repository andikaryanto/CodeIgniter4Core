<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
use App\Database\Base_migration;
class Migration_create_m_usersetting_table20181217062632 extends Base_migration {

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
            'G_Language_Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1
            ),
            'G_Color_Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1
            ),
            'RowPerpage' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 5
            )
        ));
        $forge->addKey('Id', TRUE);
        $forge->createTable('m_usersettings', TRUE);
        $this->addForeignKey('m_usersettings', 'M_User_Id', 'm_users(Id)', 'CASCADE');
        $this->addForeignKey('m_usersettings', 'G_Language_Id', 'g_languages(Id)');
        $this->addForeignKey('m_usersettings', 'G_Color_Id', 'g_colors(Id)');
    
        
        $dataSetting = [
            'M_User_Id' => '1'
        ];
        
        $builder = $db->table('m_usersettings');
        $builder->insert($dataSetting);
        
    }

    public function down() {
        //$forge->drop_table('create_m_usersetting_table20181217062632');
    }

}