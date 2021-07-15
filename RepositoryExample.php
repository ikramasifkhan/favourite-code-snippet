<?php
namespace App\Repositories;

use App\Models\Development\Package;

class PackageRepository implements PackageInterface{
    
    public function allPackage(){
        return Package::all();
    }
    public function createPackage(){

    }
    public function editPackage(){

    }
    public function updatePackage(){

    }
    public function statusUpdate(){

    }
}
