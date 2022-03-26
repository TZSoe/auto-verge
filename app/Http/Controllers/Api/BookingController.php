<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Interfaces\BookingRepositoryInterface;
use App\Interfaces\ServiceRepositoryInterface;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingCollection;
use Illuminate\Support\Carbon;
use App\Events\BookingDone;
use App\Events\CarIsTakenBack;



class BookingController extends Controller
{
    private BookingRepositoryInterface $bookingRepository;
    private ServiceRepositoryInterface $serviceRepository;

    public function __construct(BookingRepositoryInterface $bookingRepository,ServiceRepositoryInterface $serviceRepository) 
    {
        $this->bookingRepository = $bookingRepository;
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = $this->bookingRepository->getAllBookings();
        return response()->json([
            'status' => 'success',
            'data' => new BookingCollection($bookings)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingStoreRequest $request)
    {
        $date = Carbon::createFromFormat('d/m/Y', $request->date)->format("Y-m-d");
        $bookingData['date'] = $date;
        $bookingData['customer_id'] = $request->customer_id;
        $bookingData['car_number'] = $request->car_number;
        $bookingData['duration'] = $request->duration;
        $bookingData['notes'] = $request->notes;

        $booking = $this->bookingRepository->createBooking($bookingData);
        $this->bookingRepository->syncServicesToBooking($booking, $request->services);

        BookingDone::dispatch($booking);

        return response()->json([
            'status' => 'success',
            'data' => new BookingResource($booking)
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
        $booking = $this->bookingRepository->getBookingById($id);
        return response()->json([
            'status' => 'success',
            'data' => new BookingResource($booking)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookingUpdateRequest $request, $id)
    {
        $bookingData = [];

        if($request->has('date')){
            $date = Carbon::createFromFormat('d/m/Y', $request->date)->format("Y-m-d");
            $bookingData['date'] = $date;
        }

        if($request->has('customer_id')){
            $bookingData['customer_id'] = $request->customer_id;
        }

        if($request->has('car_number')){
            $bookingData['car_number'] = $request->car_number;
        }

        if($request->has('duration')){
            $bookingData['duration'] = $request->duration;
        }

        if($request->has('notes')){
            $bookingData['notes'] = $request->notes;
        }       

        $booking = $this->bookingRepository->updateBooking($id, $bookingData);

        if($request->has('services')){
            $this->bookingRepository->syncServicesToBooking($booking, $request->services);
        }

        return response()->json([
            'status' => 'success',
            'data' => new BookingResource($booking)
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
        $this->bookingRepository->deleteBooking($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function paid($id){
        $booking = $this->bookingRepository->paidBooking($id);

        CarIsTakenBack::dispatch($booking);

        return response()->json([
            'status' => 'success',
            'data' => new BookingResource($booking)
        ]);
    }
}
