<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CrudInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function show($id);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy($id);
}
