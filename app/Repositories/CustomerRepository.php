<?php

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface 
{
    public function getAllCustomers() 
    {
        return Customer::paginate(10);
    }

    public function getCustomerById($customerId) 
    {
        return Customer::findOrFail($customerId);
    }

    public function createCustomer(array $customerData) 
    {
        return Customer::create($customerData);
    }

    public function updateCustomer($customerId, array $customerData) 
    {
        $customer = $this->getCustomerById($customerId);
        $customer->update($customerData);
        return $customer;
    }

    public function deleteCustomer($customerId) 
    {
        $customer = $this->getCustomerById($customerId);
        $customer->delete();
    }
}
