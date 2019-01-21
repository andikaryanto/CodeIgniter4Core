<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class Migration_create_m_from_table extends Migration {

    public function up() {
        
        $forge = \Config\Database::forge();
        $db = \Config\Database::connect();
        $forge->addField(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'FormName' => array(
                'type' => 'varchar',
                'constraint' => 100
            ),
            'AliasName' => array(
                'type' => 'varchar',
                'constraint' => 100
            ),
            'LocalName' => array(
                'type' => 'varchar',
                'constraint' => 100
            ),
            'ClassName' => array(
                'type' => 'varchar',
                'constraint' => 100
            ),
            'Resource' => array(
                    'type' => 'Varchar',
                    'constraint' => 50,
                    'null' => true
            ),
            'IndexRoute' => array(
                'type' => 'Varchar',
                'constraint' => 50,
                'null' => true
            )
        ));
        $forge->addKey('Id', TRUE);
        $forge->createTable('m_forms', TRUE);
        
    }

    public function down() {
        // $forge->drop_table('m_form');
    }

}