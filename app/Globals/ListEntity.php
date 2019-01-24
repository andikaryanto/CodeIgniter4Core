<?php namespace App\Globals;
class ListEntity {

    protected $list = array();
    protected $typeobject;
    protected $type;
    protected $data;

    public function __construct($type){
        $this->typeobject = 'App\\Entities\\'.$type;
        $this->type = $type;
    }

    public function add($object){
        if($object != null)
            if(explode('\\', get_class($object))[2] == $this->type){
                // array_push($this->list, $object);
                // echo json_encode($object);
                $this->list[$object->Id] = $object;
                //array_merge($this->list, $this->data);
                
            } 
            else {
                throw new \Excepton;
            }
        return $this;
    }

    public function remove($object){
        if($object != null)
            if(explode('\\', get_class($object))[2] == $this->type){
                $index = array_search($object, $this->list);
                unset($this->list[$index]);
            }

        return $this;
    }

    public function where($column, $value){
        $newclass = clone $this;
        if(!empty($value)){
            unset($newclass->list);
            foreach($this->list as $data){
                if($data->$column == $value){
                    $newclass->list[$data->Id] = $data;
                }
            }
        }
        return $newclass;
    }

    public function whereNot($column, $value){
        $newclass = clone $this;
        if(!empty($value)){
            unset($newclass->list);
            foreach($this->list as $data){
                if($data->$column != $value){
                    $newclass->list[$data->Id] = $data;
                }
            }
        }
        return $newclass;
    }

    public function whereIn($column, $arrValue){
        $newclass = clone $this;
        if(!empty($arrValue)){
            unset($newclass->list);
            foreach($this->list as $data){
                if(in_array($data->$column, $arrValue)){
                    $newclass->list[$data->Id] = $data;
                }
            }
        }
        return $newclass;
    }

    public function whereNotIn($column, $arrValue){
        $newclass = clone $this;
        if(!empty($arrValue)){
            unset($newclass->list);
            foreach($this->list as $data){
                if(in_array($data->$column, $arrValue)){
                    
                } else {
                    $newclass->list[$data->Id] = $data;
                }
            }
        }
        return $newclass;
    }

    public function like($column, $value){
        $newclass = clone $this;
        if(!empty($value)){
            unset($newclass->list);
            foreach($this->list as $data){
                if(strpos($data->$column, $value) !== false){
                    $newclass->list[$data->Id] = $data;
                }
            }
        }
        return $newclass;
    }

    public function count(){
        return count($this->list);
    }

    public function getFirst(){
        return reset($this->list);
    }

    public function getAll(){
        return $this->list;
    }
    
}