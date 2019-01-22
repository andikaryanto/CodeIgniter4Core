<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
use App\Database\Base_migration;
class Migration_insert_m_form extends Base_migration {

    private $table = 'm_forms';
    public function up() {
        $forge = $this->forge();
        $db = $this->db();
        $data = array('data' =>
            array(
                'FormName' => 'm_groupusers',
                'AliasName' => 'master group user',
                'LocalName' => 'master grup pengguna',
                'ClassName' => 'Master',
                'Resource' => 'Form.groupuser',
                'IndexRoute' => 'mgroupuser'
            ),
            array(
                'FormName' => 'm_users',
                'AliasName' => 'master user',
                'LocalName' => 'master pengguna',
                'ClassName' => 'Master',
                'Resource' => 'Form.user',
                'IndexRoute' => 'muser'
            )
        );

        $builder = $db->table('m_forms');
        foreach ($data as $value){
            $builder->insert($value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('insert_m_form');
    }

}