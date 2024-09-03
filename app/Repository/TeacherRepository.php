<?php

namespace App\Repository;

use App\Interfaces\CrudInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class TeacherRepository implements CrudInterface
{
    use ApiResponseTrait;
    public function index(){}
    public function create(){}
    public function store(Request $request){}
    public function show($id){}
    public function edit($id){}
    public function update(Request $request, $id){}
    public function destroy($id){}

}
