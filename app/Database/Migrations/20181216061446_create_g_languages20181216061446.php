<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
use App\Database\Base_migration;
class Migration_create_g_languages20181216061446 extends Base_migration {

    public function up() {
    
        $forge = $this->forge();
        $db = $this->db();

        $forge->addField(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'Name' => array(
                'type' => 'Varchar',
                'constraint' => 50,
            )
        ));
        $forge->addKey('Id', TRUE);
        $forge->createTable('g_languages', TRUE);
        
        $data = array('data' =>
            array(
                'Name' => 'indonesia'
            ),
            array(
                'Name' => 'english'
            ),
        );
        
        $builder =$db->table('g_languages');
        foreach ($data as $value){
            $builder->insert($value);
        }
        
        $forge->addField(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'Name' => array(
                'type' => 'Varchar',
                'constraint' => 300,
            ),
            'Value' => array(
                'type' => 'Varchar',
                'constraint' => 300,
            ),
            'CssClass' => array(
                'type' => 'Varchar',
                'constraint' => 300,
            ),
            'CssPath' => array(
                'type' => 'Varchar',
                'constraint' => 300,
            ),
            'CssCustomPath' => array(
                'type' => 'Varchar',
                'constraint' => 300,
            )
        ));


        $forge->addKey('Id', TRUE);
        $forge->createTable('g_colors', TRUE);
        
        $data = array('data' =>
            array(
                'Name' => 'primary',
                'Value' => '#9c27b0',
                'CssClass' => 'text-primary',
                'CssPath' => 'assets/material-dashboard/assets/css/material-dashboard.min.css',
                'CssCustomPath' => 'assets/material-dashboard/assets/css/custom.css',

            ),
            array(
                'Name' => 'green',
                'Value' => '#4caf50',
                'CssClass' => 'text-success',
                'CssPath' => 'assets/material-dashboard/assets/css/material-dashboard.greeen.min.css',
                'CssCustomPath' => 'assets/material-dashboard/assets/css/custom.green.css'
            ),
        );
        
        $builder = $db->table('g_colors');
        foreach ($data as $value){
            $builder->insert($value);
        }
    }

    public function down() {
    }

}