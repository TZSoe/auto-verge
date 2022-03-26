<?php

namespace App\Interfaces;

interface ServiceRepositoryInterface 
{
    public function getAllServices();
    public function getServiceById($serviceId);
    public function createService(array $serviceData);
    public function updateService($serviceId, array $serviceData);
    public function deleteService($serviceId);
}