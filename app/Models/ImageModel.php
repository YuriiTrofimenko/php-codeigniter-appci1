<?php namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model {

    protected $table      = 'images';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['path', 'item_id'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}