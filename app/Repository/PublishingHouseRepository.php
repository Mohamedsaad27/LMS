<?php

namespace App\Repository;

use App\Api\Requests\PublishingHouseRequests\StorePublishingHouseRequest;
use App\Interfaces\PublishingHouseInterface;
use App\Models\PublishingHouse;
use App\Traits\ApiResponseTrait;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublishingHouseRepository implements PublishingHouseInterface
{
    use ApiResponseTrait;
    public function index(){
        try {
            $publishingHouses = PublishingHouse::all();
            if ($publishingHouses->isEmpty()) {
                return $this->errorResponse(trans('messages.no_publishing_house'),404);
            }
            return $this->successResponse($publishingHouses,trans('messages.publishing_houses_retrieved_successfully'));
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(),500);
        }
    }
    public function create(){}
    public function store(StorePublishingHouseRequest $request){
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
           $publishingHouse =  PublishingHouse::create($validatedData);
           DB::commit();
           if ($publishingHouse) {
               return $this->successResponse(trans('messages.publishing_house_created_successfully'));
           }
           return $this->errorResponse(trans('messages.publishing_house_created_failed'),400);
        }catch (\Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage(),500);
        }
    }
    public function show($id){}
    public function edit($id){}
    public function update(Request $request, $id){}
    public function destroy($id){}
}
