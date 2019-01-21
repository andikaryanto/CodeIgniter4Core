<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
use App\Database\Base_migration;
class Migration_insert_m_userprofile20181218145834 extends Base_migration {

    public function up() {
        $forge = $this->forge();
        $db = $this->db();
        $dataSetting = [
            'M_User_Id' => '1',
            'PhotoPath' => "./assets/user_profile/",
            'PhotoName' => "user_default.png"
        ];
        
        $builder = $db->table('m_userprofiles');
        $builder->insert($dataSetting);
    }

    public function down() {
    }

}