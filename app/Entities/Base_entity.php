<?php namespace App\Entities;
use CodeIgniter\Entity;

class Base_entity extends Entity
{
    protected $session;
    protected $db;
    protected $table='';
    protected $model='';
    protected $modelobject = '';
    protected $newmodel;
    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();

        if (!$this->table)
            $this->table = explode("\\", str_replace('_entity', '', strtolower(get_class($this))))[2];

        if (!$this->modelobject)
            $this->modelobject = model($this->table);

        //$fields = $this->db->getFieldData(table($this->table));
        
        $this->new_model();
    }

    
    public function __call($name, $argument){

        if (substr($name, 0, 4) == 'get_' && substr($name, 4, 5) != 'list_')
		{
			$entity = 'App\\Entities\\'.entity(substr($name, 4));
			if(isset($this->$field)){
                $entityobject = new $entity;
                $result = $entityobject->find($this->$field);
                return $result;
			} else {
				return null;
			}
			
		} else if (substr($name, 0, 4) == 'get_' && substr($name, 4, 5) == 'list_') {
            
            $entity = 'App\\Entities\\'.entity(substr($name, 9));
            $field = $this->table.'_Id';

			if(isset($this->Id)){
                $entityobject = new $entity;
                $params = array(
                    'where' => array(
                        $field => $this->Id
                    )
                );
                $result = $entityobject->findAll($params);
				return $result;
			}
			return array();
		} else {
			trigger_error('Call to undefined method '.__CLASS__.'::'.$name.'()', E_USER_ERROR);
		}
        
    }
    
    public function save(){
        $new_id = 0;
        if($this->Id){
            $this->ModifiedBy = $_SESSION[getSessionVariable_config()['userdata']]['Username'];
            $this->Modified = getFormatedDate();
            $this->newmodel->update($this->Id, $this);
            $new_id = $this->Id;
        } else {      
            $this->CreatedBy = $_SESSION[getSessionVariable_config()['userdata']]['Username'];
            $this->Created = getFormatedDate();
            $this->newmodel->insert($this);
            $new_id = $this->newmodel->insertID();
        }
        return $new_id;
    }

    public function delete(){
        if(!$this->newmodel->delete($this->Id));
            return $this->newmodel->error();
        return $this->newmodel->affectedRows();
    }

    public function findAll($params = null){
        $list_data = [];

        $where = (isset($params['where']) ? $params['where'] : FALSE);
        $where_not_in = (isset($params['where_not_in']) ? $params['where_not_in'] : FALSE);

        $data = $this->newmodel;
        if ($where){
			foreach($where as $key => $value){
                $data = $data->where($key, $value);
			}
        }

        if($where_not_in){
            $index = 0;
            foreach($where_not_in as $key => $value){
               foreach($value as $valuedata){
                    $data = $data->where($key, $valuedata);
               }
			}
        }

        $list =  $data->findAll();

        $fields = $this->db->getFieldData(table($this->table));
        foreach ($list as $arrdata){
            $entity = new $this;
            foreach ($fields as $field)
            {
                $name = $field->name;
                $entity->$name = $arrdata[$name];
            }
            array_push($list_data, $entity);
        }
        return $list_data;

    }

    public function find($id){
        $data = $this->newmodel->find($id);
        $fields = $this->db->getFieldData(table($this->table));
        foreach ($fields as $field)
        {
            $name = $field->name;
            $this->$name = $data[$name];
        }
        return $this;
    }

    public function first($params = null){
        $result = $this->findAll($params);
        if($result){
            return $result[0];
        }
        return null;
    }

    public function new_model(){
        $this->model = 'App\\Models\\'.$this->modelobject;
        $this->newmodel = new $this->model();
    }

    public function db(){
        return \Config\Database::connect();
    }

    public function forge(){
        return \Config\Database::forge();
    }


}


// For standalone distrubution
if (!defined('MYSQL_EMPTYDATE')) define('MYSQL_EMPTYDATE', '0000-00-00');
if (!defined('MYSQL_EMPTYDATETIME')) define('MYSQL_EMPTYDATETIME', '0000-00-00 00:00:00');
if (!function_exists('mysqldatetime'))
{
	function mysqldatetime($timestamp)
	{
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('Asia/Jakarta'));
		return $date->format('Y-m-d H:i:s');
		//return date('Y-m-d H:i:s', $timestamp);
	}
}
if (!function_exists('model'))
{
	function model($entity)
	{
		helper('inflector');
		return ucfirst(plural($entity)).'_model';
		//return plural($entity);
	} 
}
if (!function_exists('table'))
{
	function table($entity)
	{
		helper('inflector');
		return plural($entity);
	}
}
if (!function_exists('entity'))
{
	function entity($table)
	{
		helper('inflector');
		return singular($table).'_entity';
	}
}

if (!function_exists('column'))
{
	function column($entity)
	{
		$new_str = "";
		$str_arr = explode("_",$entity);
		foreach($str_arr as $str){
			$new_str = $new_str.ucfirst($str)."_";
		}
		return substr($new_str, 0, strlen($new_str) - 1);
	}
}

