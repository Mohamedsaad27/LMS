<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Dotenv\Repository\RepositoryInterface;
use App\Http\Resources\PublishingHouseResource;
use App\Interfaces\PublishingRepositoryHouseInterface;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Api\Requests\PublishingHouseRequests\StorePublishingHouseRequest;
use App\Api\Requests\PublishingHouseRequests\UpdatePublishingHouseRequest;

class PublishingRepositoryHouseRepository implements PublishingRepositoryHouseInterface
{
    use ApiResponseTrait;
    public function index(){
        try {
            $publishingHouses = Organization::with('user')->get();
            if ($publishingHouses->isEmpty()) {
                return $this->errorResponse(trans('messages.no_publishing_house'),404);
            }
            return $this->successResponse(PublishingHouseResource::collection($publishingHouses),trans('messages.publishing_houses_retrieved_successfully'));
        }
        catch (\Exception $e){
            return $this->errorResponse(trans('messages.server_error'), 500);
        }
    }
    public function create(){}
    public function store(StorePublishingHouseRequest $request){
//        dd($request);
        try {

            // if (!auth()->user()->hasRole('admin')) {
            //     return $this->errorResponse(trans('messages.unauthorized_access_to_publishing_houses'), 403);
            // }

            $validatedData = $request->validated();
            DB::beginTransaction();
            $user = User::create([
                'name_ar' => $validatedData['name_ar'],
                'name_en' => $validatedData['name_en'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'user_type_id' => 4,
            ]);
            $user->assignRole('publishing-house');
            $publishingHouse = Organization::create([
                'user_id' => $user->id,
                'logo' => $validatedData['logo'] ?? 'default.png',
                'established_year' => $validatedData['established_year'],
                'description_ar' => $validatedData['description_ar'],
                'description_en' => $validatedData['description_en'],
                'total_books' => $validatedData['total_books'],
            ]);
            DB::commit();
            return $this->successResponse(new PublishingHouseResource($publishingHouse),trans('messages.publishing_house_created_successfully'));
        }catch (\Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function show($id){}
    public function edit($id){}
    public function update(Request $request, $id)
    {

        try {
            $publishingHouse = Organization::find($id);

            if (!$publishingHouse) {
                return $this->errorResponse(trans('messages.publishing_house_not_found'), 404);
            }

            if (!auth()->user()->hasRole('admin')) {
                return $this->errorResponse(trans('messages.unauthorized_access_to_publishing_houses'), 403);
            }

            DB::beginTransaction();

            if ($request->hasFile('logo')) {
                $directoryPath = 'publishing_houses/logo/' . $id;
                $logoPath = $request->file('logo')->store($directoryPath, 'public');
                $validatedData['logo'] = $logoPath;  // This stores the relative path in the database
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
            return $this->errorResponse(trans('messages.server_error'), 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Fetch the publishing house by ID
            $publishingHouse = Organization::find($id);

            // Check if the publishing house exists
            if (!$publishingHouse) {
                return $this->errorResponse(trans('messages.publishing_house_not_found'), 404);
            }

            // Check if the user is authorized
            if (!auth()->user()->hasRole('admin')) {
                return $this->errorResponse(trans('messages.unauthorized_access_to_publishing_houses'), 403);
            }

            // Fetch the associated user
            $user = User::find($publishingHouse->user_id);

            // If publishing house has a logo, delete it from storage
            if ($publishingHouse->logo) {
                $logoPath = public_path('storage/' . $publishingHouse->logo);
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }
            // Set Schools Related With This PH to NULL
            foreach ($publishingHouse->schools as $school) {
                $school->update(['publishing_house_id' => null]);
            }

            // Delete the publishing house and the associated user
            $publishingHouse->delete();
            if ($user) {
                $user->delete();
            }

            return $this->successResponse(trans('messages.publishing_house_deleted_successfully'));

        } catch (\Exception $e) {
            return $this->errorResponse(trans('messages.server_error'), 500);
        }
    }


}
