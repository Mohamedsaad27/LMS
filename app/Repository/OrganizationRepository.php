<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Dotenv\Repository\RepositoryInterface;
use App\Http\Resources\OrganizationResource;
use App\Interfaces\OrganizationRepositoryInterface;
use PHPUnit\Framework\Constraint\FileExists;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Api\Requests\OrganizationRequests\StoreOrganizationRequest;
use App\Api\Requests\OrganizationRequests\UpdateOrganizationRequest;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    use ApiResponseTrait;
    public function index(){
        try {
            $organization = Organization::with('schools')->get();
            if ($organization->isEmpty()) {
                return $this->errorResponse(null,trans('messages.no_publishing_house'),404);
            }
            return $this->successResponse(OrganizationResource::collection($organization),trans('messages.publishing_houses_retrieved_successfully'));
        }
        catch (\Exception $e){
            return $this->errorResponse($e->getMessage(),trans('messages.server_error'), 500);
        }
    }
    public function store(StoreOrganizationRequest $request){
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $imagePath = 'uploads/images/organizations/';
                if(!File::isDirectory($imagePath)){
                    File::makeDirectory($imagePath, 0777, true, true);
                }
                $image->move(public_path($imagePath), $imageName);
                $validatedData['logo'] = env('APP_URL') . '/' .$imagePath . '/' . $imageName;
            }
            if (Organization::where('email', $validatedData['email'])->exists()) {
                return $this->errorResponse(null,trans('messages.email_already_exists'), 422);
            }
            $organization = Organization::create([
                'name_ar' => $validatedData['name_ar'],
                'name_en' => $validatedData['name_en'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'logo' => $validatedData['logo'] ?? 'default.png',
                'established_year' => $validatedData['established_year'] ?? null,
                'description_ar' => $validatedData['description_ar']?? null,
                'description_en' => $validatedData['description_en']?? null,
                'phone' => $validatedData['phone']?? null,
                'address' => $validatedData['address']?? null,
            ]);
            DB::commit();
            return $this->successResponse(new OrganizationResource($organization),trans('messages.organization_created_successfully'));
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            if ($e->errorInfo[1] == 1062) {
                return $this->errorResponse($e->getMessage(),trans('messages.email_already_exists'), 422);
            }
        } catch (\Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage(),trans('messages.server_error'), 500);
        }
    }
    public function update(UpdateOrganizationRequest $request, $id)
    {
        $validatedData = $request->validated();
        try {
            $organization = Organization::find($id);
            if (!$organization) {
                return $this->errorResponse(null,trans('messages.publishing_house_not_found'), 404);
            }
//            if (!auth()->user()->hasRole('admin')) {
//                return $this->errorResponse(trans('messages.unauthorized_access_to_publishing_houses'), 403);
//            }
            DB::beginTransaction();
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $imagePath = 'uploads/images/organizations/';
                if(!File::isDirectory($imagePath)){
                    File::makeDirectory($imagePath, 0777, true, true);
                }
                $image->move(public_path($imagePath), $imageName);
                $validatedData['logo'] = env('APP_URL') . '/' .$imagePath . '/' . $imageName;
            }
            $organization->update([
                'name_ar' => $validatedData['name_ar'] ?? $organization->name_ar,
                'name_en' => $validatedData['name_en'] ?? $organization->name_en,
                'email' => $validatedData['email'] ?? $organization->email,
                'password' => Hash::make($validatedData['password']) ?? $organization->password,
                'established_year' => $validatedData['established_year'] ?? $organization->established_year,
                'description_ar' => $validatedData['description_ar']?? $organization->description_ar,
                'description_en' => $validatedData['description_en']?? $organization->description_en,
                'phone' => $validatedData['phone']?? $organization->phone,
                'address' => $validatedData['address']?? $organization->address,
                'logo' => $validatedData['logo'] ?? $organization->logo,
            ]);
            DB::commit();
            return $this->successResponse($organization,trans('messages.publishing_house_updated_successfully'));
        }catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage(),trans('messages.server_error'), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $organization = Organization::find($id);
            if (!$organization) {
                return $this->errorResponse(null,trans('messages.publishing_house_not_found'), 404);
            }
//            if (!auth()->user()->hasRole('admin')) {
//                return $this->errorResponse(trans('messages.unauthorized_access_to_publishing_houses'), 403);
//            }

            if ($organization->logo) {
                $logoPath = public_path('uploads/organizations/' . $organization->logo);
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }
            foreach ($organization->schools as $school) {
                $school->update(['organization_id' => null]);
            }
            $organization->delete();
            return $this->successResponse(trans('messages.publishing_house_deleted_successfully'));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(),trans('messages.server_error'), 500);
        }
    }


}
