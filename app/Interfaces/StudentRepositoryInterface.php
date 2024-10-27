<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface StudentRepositoryInterface
{
    public function index();
    public function update(Request $request, $id);
    public function destroy($id);
}
