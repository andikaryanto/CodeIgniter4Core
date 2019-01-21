<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
use App\Database\Base_migration;
class Migration_create_m_accesrole_view extends Base_migration {

    public function up() {
        $db =  $this->db();
        $sql = "CREATE OR REPLACE VIEW view_m_accessroles
                as
                SELECT a.Id AS GroupId,
                    b.Id AS FormId, 
                    b.FormName AS FormName,
                    b.AliasName AS AliasName,
                    b.LocalName AS LocalName,
                    IFNULL(c.Read,0) AS Readd,
                    IFNULL(c.Write,0) AS Writee,
                    IFNULL(c.Delete,0) AS Deletee,
                    IFNULL(c.Print,0) AS Printt,
                    b.ClassName AS ClassName,
                    0 AS Header
                FROM ((m_groupusers a JOIN m_forms b) 
                LEFT JOIN m_accessroles c ON(((c.M_Form_Id = b.Id) 
                    AND (c.M_Groupuser_Id = a.Id)))) 
                UNION ALL 
                SELECT DISTINCT NULL,
                    NULL,
                    NULL,
                    ClassName AS ClassName,
                    NULL,
                    NULL,
                    NULL,
                    NULL,
                    NULL,
                    ClassName AS ClassName,
                    1 AS Header 
                FROM m_forms ORDER BY 10,11";
      $db->query($sql);
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_accesrole_view');
    }

}