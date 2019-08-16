<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 16.08.19
 * Time: 15:19
 */

namespace user\models;

use admin\models\ProductsModel;
use core\models\BaseModel;


class CatalogModel extends BaseModel{

    protected $products;

    public function CatalogProd(){

        $this->products = new ProductsModel();

        return $this->products->get();


    }

}