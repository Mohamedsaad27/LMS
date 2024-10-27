<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\StudentRepositoryInterface;

class StudentController extends Controller
{
    protected $studentRepository;
    public function __construct(StudentRepositoryInterface $studentRepository){
        $this->studentRepository = $studentRepository;
    }
    public function index(){
        return $this->studentRepository->index();
    }
    public function update(Request $request, $id){
        return $this->studentRepository->update($request, $id);
    }
    public function destroy($id){
        return $this->studentRepository->destroy($id);
    }
}

