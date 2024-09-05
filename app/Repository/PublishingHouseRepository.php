<?php

namespace App\Repository;

use App\Api\Requests\PublishingHouseRequests\StorePublishingHouseRequest;
use App\Api\Requests\PublishingHouseRequests\UpdatePublishingHouseRequest;
use App\Http\Resources\PublishingHouseResource;
use App\Interfaces\PublishingHouseInterface;
use App\Models\PublishingHouse;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PublishingHouseRepository implements PublishingHouseInterface
{
    use ApiResponseTrait;
    public function index(){
        try {
            $publishingHouses = PublishingHouse::all();
            if ($publishingHouses->isEmpty()) {
                return $this->errorResponse(trans('messages.no_publishing_house'),404);
            }
            return $this->successResponse(PublishingHouseResource::collection($publishingHouses),trans('messages.publishing_houses_retrieved_successfully'));
        }
        catch (\Exception $e){
            return $this->errorResponse($e->getMessage(),500);
        }
    }
    public function create(){}
    public function store(StorePublishingHouseRequest $request){

    }
    public function show($id){}
    public function edit($id){}
    public function update(Request $request, $id)
    {

        try {
            $publishingHouse = PublishingHouse::find($id);

            if (!$publishingHouse) {
                return $this->errorResponse(trans('messages.publishing_house_not_found'), 404);
            }

            if (!auth()->user()->hasRole('publishing-house')) {
                return $this->errorResponse(trans('messages.unauthorized_access_to_publishing_houses'), 403);
            }

            DB::beginTransaction();

            if ($request->hasFile('logo')) {
                $directoryPath = 'publishing_houses/logo/' . $id;
                $logoPath = $request->file('logo')->store($directoryPath, 'public');
                $validatedData['logo'] = $logoPath;
            }

            // Update only the fields that are present in the request
            $publishingHouse->update([
                'logo' =>   $request->logo,
                'description_ar' =>  $request->description_ar,
                'description_en' => $request->description_en,
                'established_year' => $request->established_year,
                'total_books' => $request->total_books,
            ]);

            DB::commit();

            return $this->successResponse($publishingHouse,trans('messages.publishing_house_updated_successfully'));
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return $this->errorResponse(trans('messages.publishing_house_not_found'), 404);
        } catch (UnauthorizedException $e) {
            DB::rollBack();
            return $this->errorResponse(trans('messages.unauthorized_access_to_publishing_houses'), 403);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $publishingHouse = PublishingHouse::find($id);
            $user = User::find($publishingHouse->user_id);
            if (!$publishingHouse) {
                return $this->errorResponse(trans('messages.publishing_house_not_found'), 404);
            }
            if (!auth()->user()->hasRole(['admin','publishing-house'])) {
                return $this->errorResponse(trans('messages.unauthorized_access_to_publishing_houses'), 403);
            }
            if ($publishingHouse->logo) {
                $logoPath = storage_path('app/public/' . $publishingHouse->logo);
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }
            $publishingHouse->delete();
            $user->delete();
            return $this->successResponse(trans('messages.publishing_house_deleted_successfully'));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

}
