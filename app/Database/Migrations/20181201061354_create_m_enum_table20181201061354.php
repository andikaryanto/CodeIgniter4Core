<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
use App\Database\Base_migration;
class Migration_create_m_enum_table20181201061354 extends Base_migration {

    private $tabledetail = 'm_enumdetails';
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
                'type' => 'VARCHAR',
                'constraint' => 100
            )
        ));
        $forge->addKey('Id', TRUE);
        $forge->createTable('m_enums', TRUE);

        //insert data
        $data = array('data' =>
            
            array(
                'Name' => 'Months'
            ),
            array(
                'Name' => 'Gender'
            ),
            array(
                'Name' => 'Religion'
            ));
        
        $builder =$db->table('m_enums');
        foreach ($data as $value){
            $builder->insert($value);
        }
        
        $forge->addField(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'M_Enum_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'Value' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'EnumName' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
            ),
            'Ordering' => array(
                'type' => 'TINYINT',
                'constraint' => 11
            ),
            'Resource' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            )
        ));

        $forge->addKey('Id', TRUE);
        $forge->createTable('m_enumdetails');
        $this->addForeignKey('m_enumdetails', 'M_Enum_Id', 'm_enums(Id)', 'CASCADE');

        //insert data
        $data = array('data' =>
            
            array(
                'M_Enum_Id' => 1,
                'Value' => 1,
                'EnumName' => 'January',
                'Ordering' => 1,
                'Resource' => 'ui_january'
            ),
            array(
                'M_Enum_Id' => 1,
                'Value' => 2,
                'EnumName' => 'February',
                'Ordering' => 2,
                'Resource' => 'ui_february'
            ),
            array(
                'M_Enum_Id' => 1,
                'Value' => 3,
                'EnumName' => 'March',
                'Ordering' => 3,
                'Resource' => 'ui_march'
            ),
            array(
                'M_Enum_Id' => 1,
                'Value' => 4,
                'EnumName' => 'April',
                'Ordering' => 4,
                'Resource' => 'ui_april'
            ),
            array(
                'M_Enum_Id' => 1,
                'Value' => 5,
                'EnumName' => 'May',
                'Ordering' => 5,
                'Resource' => 'ui_may'
            ),
            array(
                'M_Enum_Id' => 1,
                'Value' => 6,
                'EnumName' => 'June',
                'Ordering' => 6,
                'Resource' => 'ui_june'
            ),
            array(
                'M_Enum_Id' => 1,
                'Value' => 7,
                'EnumName' => 'July',
                'Ordering' => 7,
                'Resource' => 'ui_july'
            ),
            array(
                'M_Enum_Id' => 1,
                'Value' => 8,
                'EnumName' => 'August',
                'Ordering' => 8,
                'Resource' => 'ui_august'
            ),
            array(
                'M_Enum_Id' => 1,
                'Value' => 9,
                'EnumName' => 'September',
                'Ordering' => 9,
                'Resource' => 'ui_september'
            ),
            array(
                'M_Enum_Id' => 1,
                'Value' => 10,
                'EnumName' => 'October',
                'Ordering' => 10,
                'Resource' => 'ui_october'
            ),
            array(
                'M_Enum_Id' => 1,
                'Value' => 11,
                'EnumName' => 'November',
                'Ordering' => 11,
                'Resource' => 'ui_november'
            ),
            array(
                'M_Enum_Id' => 1,
                'Value' => 12,
                'EnumName' => 'December',
                'Ordering' => 12,
                'Resource' => 'ui_december'
            ),
            array(
                'M_Enum_Id' => 2,
                'Value' => 1,
                'EnumName' => 'Male',
                'Ordering' => 1,
                'Resource' => 'ui_male'
            ),
            array(
                'M_Enum_Id' => 2,
                'Value' => 2,
                'EnumName' => 'Female',
                'Ordering' => 2,
                'Resource' => 'ui_female'
            ),
            array(
                'M_Enum_Id' => 3,
                'Value' => 1,
                'EnumName' => 'Islam',
                'Ordering' => 1
            ),
            array(
                'M_Enum_Id' => 3,
                'Value' => 2,
                'EnumName' => 'Kristen',
                'Ordering' => 2
            ),
            array(
                'M_Enum_Id' => 3,
                'Value' => 2,
                'EnumName' => 'Katholik',
                'Ordering' => 3
            ),
            array(
                'M_Enum_Id' => 3,
                'Value' => 4,
                'EnumName' => 'Hindu',
                'Ordering' => 4
            ),
            array(
                'M_Enum_Id' => 3,
                'Value' => 5,
                'EnumName' => 'Budha',
                'Ordering' => 5
            ),
            array(
                'M_Enum_Id' => 3,
                'Value' => 6,
                'EnumName' => 'None',
                'Ordering' => 6
            )
        );
        
        $builder =$db->table('m_enumdetails');
        foreach ($data as $value){
            $builder->insert($value);
        }
    }

    public function down() {
        // $forge->drop_table('m_enumdetails');
        // $forge->drop_table('m_enums');
    }

}