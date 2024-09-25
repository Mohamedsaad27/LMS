<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Dotenv\Repository\RepositoryInterface;
use App\Http\Resources\OrganizationResource;
use App\Interfaces\OrganizationRepositoryInterface;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Api\Requests\OrganizationRequests\StoreOrganizationRequest;
use App\Api\Requests\OrganizationRequests\UpdateOrganizationRequest;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    use ApiResponseTrait;
    public function index(){
        try {
            $publishingHouses = Organization::with('schools','subjects')->get();
            if ($publishingHouses->isEmpty()) {
                return $this->errorResponse(trans('messages.no_publishing_house'),404);
            }
            return $this->successResponse(OrganizationResource::collection($publishingHouses),trans('messages.publishing_houses_retrieved_successfully'));
        }
        catch (\Exception $e){
            return $this->errorResponse(trans('messages.server_error'), 500);
        }
    }
    public function store(StoreOrganizationRequest $request){
        try {
            // if (!auth()->user()->hasRole('admin')) {
            //     return $this->errorResponse(trans('messages.unauthorized_access_to_publishing_houses'), 403);
            // }

            $validatedData = $request->validated();
            DB::beginTransaction();
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $imagePath = public_path('images/organizations/logos'.$imageName);
                $image->move(public_path('images/organizations/logos'),$imageName);
                $validatedData['logo'] = $imagePath;
            }
            if (Organization::where('email', $validatedData['email'])->exists()) {
                return $this->errorResponse(trans('messages.email_already_exists'), 422);
            }
            $organization = Organization::create([
                'name_ar' => $validatedData['name_ar'],
                'name_en' => $validatedData['name_en'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'logo' => $validatedData['logo'] ?? 'default.png',
                'established_year' => $validatedData['established_year'],
                'description_ar' => $validatedData['description_ar'],
                'description_en' => $validatedData['description_en'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
            ]);
            DB::commit();
            return $this->successResponse(new OrganizationResource($organization),trans('messages.organization_created_successfully'));
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            if ($e->errorInfo[1] == 1062) {
                return $this->errorResponse(trans('messages.email_already_exists'), 422);
            }
            return $this->errorResponse(trans('messages.server_error'), 500);
        } catch (\Exception $e){
            DB::rollBack();
            return $this->errorResponse(trans('messages.server_error'), 500);
        }
    }
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
