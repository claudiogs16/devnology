<?php

namespace App;

class Product{
    public $id;
    public $supplier_id;
    public $name;
    public $description;
    public $price;
    public $discountValue = 0;
    public $hasDiscount = false;
    public $details = null;
    public $images = [];
    public $category = null;
    public $department = null;
    public $material = null;


    public function __construct($id, $name, $description, $price){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;

    }

    public function setSupplierID($supplier_id){
        $this->supplier_id = $supplier_id;
    }


    public function setHasDiscount($hasDiscount){
        $this->hasDiscount = $hasDiscount;
    }

    public function setDiscountValue($discountValue){
        $this->discountValue = $discountValue;
    }

    public function setCategory($category){
        $this->category = $category;
    }

    public function setDepartment($department){
        $this->department = $department;
    }

    public function setMaterial($material){
        $this->material = $material;
    }

    public function setDetails($details){
        $this->details = $details;
    }

    public function setImages($image){
        $this->images[] = stripslashes($image);
    }

    // public function rmImages($image){
    //     $index = array_search($image, $this->image);
    //     if ($index !== false) {
    //     unset($this->images[$index]);
    //     }
    // }


}


?>
