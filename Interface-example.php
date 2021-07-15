<?php

namespace App\Repositories;

interface PackageInterface{
    public function allPackage();
    public function createPackage();
    public function editPackage();
    public function updatePackage();
    public function statusUpdate();
}
