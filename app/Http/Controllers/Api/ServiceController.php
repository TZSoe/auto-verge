<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Interfaces\ServiceRepositoryInterface;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ServiceCollection;


class ServiceController extends Controller
{
    private ServiceRepositoryInterface $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository) 
    {
        $this->serviceRepository = $serviceRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $this->serviceRepository->getAllServices();
        return response()->json([
            'status' => 'success',
            'data' => new ServiceCollection($services)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceStoreRequest $request)
    {
        $serviceData['type'] = $request->type;

        $service = $this->serviceRepository->createService($serviceData);

        return response()->json([
            'status' => 'success',
            'data' => new ServiceResource($service)
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
        $service = $this->serviceRepository->getServiceById($id);
        return response()->json([
            'status' => 'success',
            'data' => new ServiceResource($service)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdateRequest $request, $id)
    {
        
        $serviceData['type'] = $request->type;

        $service = $this->serviceRepository->updateService($id, $serviceData);

        return response()->json([
            'status' => 'success',
            'data' => new ServiceResource($service)
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
        $this->serviceRepository->deleteService($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
