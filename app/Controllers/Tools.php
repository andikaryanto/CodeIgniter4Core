<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use App\Controllers\Base_controller;

class Tools extends Base_Controller {
    private $db;
    private $forge;
    public function __construct() {
        
        $this->db = \Config\Database::connect();
        $this->forge = \Config\Database::forge();
        // can only be called from the command line
        if (!is_cli()) {
            exit('Direct access is not allowed. This is a command line tool, use the terminal');
        }

        // $this->load->dbforge();

        // // initiate faker
        // $this->faker = Faker\Factory::create();
    }

    public function message($to = 'World') {
        echo "Hello {$to}!" . PHP_EOL;
    }

    public function help() {
        $result = "The following are the available command line interface commands\n\n";
        $result .= "php index.php tools migration \"file_name\"         Create new migration file\n";
        $result .= "php index.php tools migrate [\"version_number\"]    Run all migrations. The version number is optional.\n";
        $result .= "php index.php tools seeder \"file_name\"            Creates a new seed file.\n";
        $result .= "php index.php tools seed \"file_name\"              Run the specified seed file.\n";
        $result .= "php index.php tools controller \"file_name\"        Creates a new controller file.\n";
        $result .= "php index.php tools model \"file_name\"             Creates a new model file.\n";

        echo $result . PHP_EOL;
    }

    public function migration($name) {
        $this->make_migration_file($name);
    }

    public function migrate($version = null) {
        $migration = \Config\Services::migrations();
        $this->create_version_history();
        $versions = $this->read_version();
        $prevVersion = "";
        $countMigrate = 0;
        foreach($versions as $ver){
            
            if($this->is_exist_version_history($ver) < 1){
                if($this->must_downgrade_version($ver) > 0){
                    $this->downgrade_version($prevVersion);
                }

                if ($migration->version($ver) === FALSE) {
                    echo "here";
                    //show_error($migration->error_string());
                } else {
                    echo "Migrations run successfully " . $ver . PHP_EOL;
                    
                    $migrationVersion = array("Version" => $ver);
                    $builder = $this->db->table('g_versionhistory');
                    $builder->insert($migrationVersion);
                }
                $countMigrate++;
            }
            $prevVersion = $ver;
        }
        echo "Migrations count (" . $countMigrate .")" . PHP_EOL;

    }

    public function seeder($name) {
        $this->make_seed_file($name);
    }

    public function seed($name) {
        $seeder = new Seeder();

        $seeder->call($name);
    }

    public function controller($name){
        $this->make_controller_file($name);
    }

    public function model($name){
        $this->make_model_file($name);
    }

    protected function make_migration_file($name) {
        $date = new Time('now','Asia/Jakarta','id_ID');
        $timestamp = $date->format('YmdHis');

        $newname = $name.$timestamp;

        $table_name = strtolower($newname);

        $path = APPPATH . "Database/Migrations/$timestamp" . "_" . "$newname.php";

        $my_migration = fopen($path, "w") or die("Unable to create migration file!");
        

        $migration_template = "<?php namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class Migration_$newname extends Migration {

    public function up() {
        \$forge = \Config\Database::forge();
        \$field = [
            'Id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ]
        ];
        \$forge->addField(\$fields);
        \$forge->addKey('Id', TRUE);
        \$forge->createTable('$table_name', TRUE);
    }

    public function down() {
        \$forge->dropTable('$table_name');
    }

}";

        fwrite($my_migration, $migration_template);

        fclose($my_migration);

        echo "$path migration has successfully been created." . PHP_EOL;
    }

    protected function make_seed_file($name) {
        $path = APPPATH . "database/seeds/$name.php";

        $my_seed = fopen($path, "w") or die("Unable to create seed file!");

        $seed_template = "<?php

class $name extends Seeder {

    private \$table = 'users';

    public function run() {
        //\$this->db->truncate(\$this->table);

        //seed records manually
        \$data = [
            'user_name' => 'admin',
            'password' => '9871'
        ];
        \$this->db->insert(\$this->table, \$data);

        //seed many records using faker
        \$limit = 33;
        echo \"seeding \$limit user accounts\";

        for (\$i = 0; \$i < \$limit; \$i++) {
            echo \".\";

            \$data = array(
                'user_name' => \$this->faker->unique()->userName,
                'password' => '1234',
            );

            \$this->db->insert(\$this->table, \$data);
        }

        echo PHP_EOL;
    }
}
";

        fwrite($my_seed, $seed_template);

        fclose($my_seed);

        echo "$path seeder has successfully been created." . PHP_EOL;
    }

    protected function make_controller_file($name){

        $id = '$id';
        $loadviewparam = '$viewName, $data';
        $loadviewcontent = '$this->paging->load_header();
		$this->load->view($viewName, $data);
        $this->paging->load_footer();';
        
        $path = APPPATH . "controllers/$name.php";

        $my_controller = fopen($path, "w") or die("Unable to create model file!");

        $controller_template = "<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class $name extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // your index goes here
    }

    public function add()
    {   
        // your add method goes here
    }

    public function addsave()
    {   
        // your addsave method goes here
    }

    public function edit($id)
    {   
        // your edit method goes here
    }

    public function editsave()
    {   
        // your editsave method goes here
    }

    public function delete($id){
        // your delete method goes here

    }

    private function loadview($loadviewparam)
	{
        // your load view method goes here
		$loadviewcontent
    } 

}";

        fwrite($my_controller, $controller_template);

        fclose($my_controller);

        echo "$path controller has successfully been created." . PHP_EOL;
    }

    protected function make_model_file($name){

        $id = '$id';
        $data = '$data';
        $newname = plural($name)."_model";
        $objectname = $name."_object";

        $arrayobject = '$data = array(
        );
        return $data;';

        $validateparam = '$model, $oldmodel = null';
        
        $path = APPPATH . "models/$newname.php";

        $my_model = fopen($path, "w") or die("Unable to create model file!");

        $model_template = "<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class $newname extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function validate($validateparam){
        //validate goes here
    }

}

class $objectname extends Model_object {
   
}";

        fwrite($my_model, $model_template);

        fclose($my_model);

        echo "$path model has successfully been created." . PHP_EOL;
    }

    public function read_version(){
        $path = APPPATH . "Database/Migrations/";
        $version = array();
        if ($handle = opendir($path)) {

            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".."&& $entry != ".gitkeep") {
                    array_push($version, explode("_", $entry)[0]);
                }
            }
            closedir($handle);
        }
        return $version;
    }

    protected function must_downgrade_version($version){
        $builder = $this->db->table('migrations');
        $query = $builder->get()->getResult()[0];
        if($query->version > $version){
            $this->delete_version_history($version);
            return true;
        }
        return false;
    }

    protected function downgrade_version($version){
        $builder = $this->db->table('migrations');
        $builder->set('version', $version);
        $builder->update();
    }

    protected function delete_version_history($version){
        $builder = $this->db->table('g_versionhistory');
        $builder->where('Version > ', $version);
        $builder->delete();
    }

    public function is_exist_version_history($version){
        $isExist = false;
        $builder = $this->db->table('g_versionhistory');
        if($version == "20181126000000"){
            $isExist = true;
        } else {
            $builder->where('Version', $version);
            $query = $builder->get()->getResult()[0];
            if($query){
                $isExist = true;
            }
        }
        // print_r($query);
        return $isExist;
    }

    protected function is_exist_data_version_hitory(){   
        $builder = $this->db->table('g_versionhistory');
        $query = $builder->get()->getResult()[0];
        if($query){
            return true;
        }
        return false;
    }

    protected function create_version_history(){
            
            $field = [
                'Id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ],
                'Version' => [
                    'type' => 'varchar',
                    'constraint' => 100
                ]
    
            ];
            $this->forge->addField($field);
            $this->forge->addKey('Id', TRUE);
            $this->forge->createTable('g_versionhistory', TRUE);
        }

}