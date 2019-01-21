<?php namespace App\Entities;
use CodeIgniter\Entity;

class Base_entity extends Entity
{
    protected $db;
    protected $table='';
    protected $model='';
    protected $modelobject = '';
    protected $newmodel;
    public $field;
    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();

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
			$entity = 'App\\Entities\\'.entity(substr($name, 9));
			$field = substr($name, 4).'_Id';
			$model = model(substr($name, 4));

            $modelobject = 'App\\Models\\'.$model;
			if(isset($this->$field)){
                $object = new $modelobject;
                $list = $object->where('Id', $this->$field)->findAll();
                $fields = $this->db->getFieldData(table(substr($name, 4)));
                foreach ($list as $arrdata){
                    $entityobject = new $entity;
                    foreach($fields as $field){
                        $name = $field->name;
                        $entityobject->$name = $arrdata[$name];
                    }
                }
                return $entityobject;
			} else {
				return new $entity;
			}
			
		} else if (substr($name, 0, 4) == 'get_' && substr($name, 4, 5) == 'list_') {
            
            $entity = 'App\\Entities\\'.entity(substr($name, 9));
			$model = model(substr($name, 9));
            $field = $this->table.'_Id';
            //echo $model;
            
            $modelobject = 'App\\Models\\'.$model;
			if(isset($this->Id)){
                
                $object = new $modelobject;
				$list_data = [];
				$list = $object->where($field, $this->Id)->findAll();
				if($list){
                    $fields = $this->db->getFieldData(table(substr($name, 9)));
                    foreach ($list as $arrdata){
                        $entityobject = new $entity;
                        foreach ($fields as $field)
                        {
                            $name = $field->name;
                            $entityobject->$name = $arrdata[$name];
                        }
                        array_push($list_data, $entityobject);
                    }
                    return $list_data;
                }
					
			}
			return array();
		} else {
			trigger_error('Call to undefined method '.__CLASS__.'::'.$name.'()', E_USER_ERROR);
		}
        
    }
    
    public function save(){
        if($this->Id)
            $this->newmodel->update($this->Id, $this);
        else {      
            $this->newmodel->insert($this);
        }
    }

    public function delete(){
        $this->newmodel->delete($this->Id);
    }

    public function findAll($params = null){
        $list_data = [];
        $where = (isset($params['where']) ? $params['where'] : FALSE);	
        $data = $this->newmodel;
        if ($where){
			foreach($where as $key => $value){
                $data = $this->newmodel->where($key, $value);
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
        // $this->newmodel->returnType = get_class($this);
        // echo get_class($this);
        //echo json_encode($this);
        $data = $this->newmodel->find($id);
        $fields = $this->db->getFieldData(table($this->table));
        foreach ($fields as $field)
        {
            $name = $field->name;
            $this->$name = $data[$name];
        }
        return $this;
        
    }

    public function new_model(){
        $this->model = 'App\\Models\\'.$this->modelobject;
        $this->newmodel = new $this->model();
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

