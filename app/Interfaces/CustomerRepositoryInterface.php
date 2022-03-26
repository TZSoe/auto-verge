<?php

namespace App\Interfaces;

interface CustomerRepositoryInterface 
{
    public function getAllCustomers();
    public function getCustomerById($customerId);
    public function createCustomer(array $customerData);
    public function updateCustomer($customerId, array $customerData);
    public function deleteCustomer($customerId);
}