<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

interface UnitRepositoryInterface{
    public function index();
    public function store(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}
