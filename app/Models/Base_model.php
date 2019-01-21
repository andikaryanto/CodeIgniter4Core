<?php namespace App\Models;

use CodeIgniter\Model;

class Base_model extends Model {

    //protected $db;

    protected $table = '';
    protected $primaryKey = 'Id';
    // protected $returnType = 'App\Entities\';
    protected $useSoftDeletes = false;

    protected $allowedFields = [];
    protected $useTimestamps = false;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function __construct()
	{
        parent::__construct();
        $db = \Config\Database::connect();

        if (!$this->table)
            $this->table = explode("\\", str_replace('_model', '', strtolower(get_class($this))))[2];

        helper('inflector');
        $fields = $db->getFieldData(plural($this->table));
        foreach ($fields as $field)
        {
            array_push($this->allowedFields,$field->name);
        }
        
    }

}
