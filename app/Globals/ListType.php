<?php namespace App\Globals;
class ListType {

    protected $list = array();
    protected $type;
    protected $data;

    public function __construct($type){
        $this->type = $type;
    }

    public function add($var){
        if($var != null)
            if(get_type($var) == $this->type){
                //array_merge($this->list, $this->data);
                array_merge($this->list, array(0 => $var));
                
            } 
            else {
                throw new \CodeIgniter\Exceptions\ConfigException("Class is Not match");
            }

        return $this;
    }

    public function remove($var){
        if($var != null)
        if(get_type($var) == $this->type){
                $index = array_search($var, $this->list);
                unset($this->list[$index]);
            }

        return $this;
    }

    public function getAll(){
        return $this->list;
    }
}