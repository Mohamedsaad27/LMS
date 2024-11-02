<?php
namespace App\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\UnitRepositoryInterface;

class UnitController extends Controller implements UnitRepositoryInterface{
    protected $unitRepository;
    public function __construct(UnitRepositoryInterface $unitRepository){
        $this->unitRepository = $unitRepository;
    }
    public function index(){
        return $this->unitRepository->index();
    }
    public function store(Request $request){
        return $this->unitRepository->store($request);
    }
    public function update(Request $request, $id){
        return $this->unitRepository->update($request, $id);
    }
    public function destroy($id){
        return $this->unitRepository->destroy($id);
    }
}
