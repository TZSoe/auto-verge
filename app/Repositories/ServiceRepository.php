<?php

namespace App\Repositories;

use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Service;

class ServiceRepository implements ServiceRepositoryInterface 
{
    public function getAllServices() 
    {
        return Service::paginate(10);
    }

    public function getServiceById($serviceId) 
    {
        return Service::findOrFail($serviceId);
    }

    public function createService(array $serviceData) 
    {
        return Service::create($serviceData);
    }

    public function updateService($serviceId, array $serviceData) 
    {
        $service = $this->getServiceById($serviceId);
        $service->update($serviceData);
        return $service;
    }

    public function deleteService($serviceId) 
    {
        $service = $this->getServiceById($serviceId);
        $service->delete();
    }
}
