<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
use App\Database\Base_migration;

class Migration_create_m_company20181218153633 extends Base_migration {

    public function up() {
        $forge = $this->forge();
        $db = $this->db();
        $forge->addField(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'CompanyName' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
            ),
            'Address' => array(
                'type' => 'VARCHAR',
                'constraint' => 300
            ),
            'PostCode' => array(
                'type' => 'VARCHAR',
                'constraint' => 10
            ),
            'Email' => array(
                'type' => 'VARCHAR',
                'constraint' => 300
            ),
            'Phone' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
            ),
            'Fax' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
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
        $forge->createTable('m_companies', TRUE);

        $data = array('data' => array(
                'FormName' => 'm_companies',
                'AliasName' => 'Perusahaan',
                'LocalName' => 'Company',
                'ClassName' => 'Setup',
                'Resource' => 'Form.company',
                'IndexRoute' => 'mcompany'
            )
        );
        $builder = $db->table('m_forms');
        foreach ($data as $value){
            $builder->insert($value);
        }
    }

    public function down() {
        //$forge->drop_table('create_m_company20190110093633');
    }

}