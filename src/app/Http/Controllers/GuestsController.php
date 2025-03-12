<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Enums\CountryEnum;
use App\Http\Resources\GuestResource;
use App\Interfaces\GuestInterface;
use App\Models\Guests;
use App\Http\Requests\StoreGuestsRequest;
use App\Http\Requests\UpdateGuestsRequest;
use Illuminate\Support\Facades\DB;

class GuestsController extends Controller
{
    private GuestInterface $guestRepository;

    public function __construct(GuestInterface $guestRepository)
    {
        $this->guestRepository = $guestRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $begin = microtime(true);
        $data = $this->guestRepository->index();
        $end = microtime(true) - $begin;
        return ApiResponseClass::sendResponse(
            GuestResource::collection($data),
            time: $end,
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuestsRequest $request)
    {
        $details = [
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
        ];
        DB::beginTransaction();
        try {
            if (empty($request->country)) {
                $details['country'] = CountryEnum::getNameCountryByPhone($request->phone);
            }

            $begin = microtime(true);
            $product = $this->guestRepository->store($details);
            $end = microtime(true) - $begin;

            DB::commit();
            return ApiResponseClass::sendResponse(
                new GuestResource($product),
                'Гость успешно создан',
                201,
                time: $end
            );

        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex, $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $begin = microtime(true);
            $guest = $this->guestRepository->getById($id);
            $end = microtime(true) - $begin;
            return ApiResponseClass::sendResponse(
                new GuestResource($guest),
                time: $end
            );
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e->getMessage(), 'Пользователь не найден');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guests $guests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuestsRequest $request, $id)
    {
        $updateDetails = [
            'id' => $id,
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
        ];
        DB::beginTransaction();
        try {
            if (empty($request->country)) {
                $updateDetails['country'] = CountryEnum::getNameCountryByPhone($request->phone);
            }

            $begin = microtime(true);
            $guest = $this->guestRepository->update($updateDetails, $id);
            $end = microtime(true) - $begin;

            DB::commit();
            return ApiResponseClass::sendResponse(
                'Объект успешно обновлен',
                code: 201,
                time: $end
            );
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex, $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $begin = microtime(true);
        $this->guestRepository->delete($id);
        $end = microtime(true) - $begin;

        return ApiResponseClass::sendResponse(
            'Объект успешно удален',
            time: $end,
        );
    }
}
