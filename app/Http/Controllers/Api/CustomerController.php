<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Interfaces\CustomerRepositoryInterface;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerCollection;



class CustomerController extends Controller
{
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository) 
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->customerRepository->getAllCustomers();
        return response()->json([
            'status' => 'success',
            'data' => new CustomerCollection($customers)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        $customerData['name'] = $request->name;
        $customerData['email'] = $request->email;

        $customer = $this->customerRepository->createCustomer($customerData);

        return response()->json([
            'status' => 'success',
            'data' => new CustomerResource($customer)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = $this->customerRepository->getCustomerById($id);
        return response()->json([
            'status' => 'success',
            'data' => new CustomerResource($customer)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, $id)
    {
        $customerData = [];

        if($request->has('name')){
            $customerData['name'] = $request->name;
        }
        if($request->has('email')){
            $customerData['email'] = $request->email;
        }

        $customer = $this->customerRepository->updateCustomer($id, $customerData);

        return response()->json([
            'status' => 'success',
            'data' => new CustomerResource($customer)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->customerRepository->deleteCustomer($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}

