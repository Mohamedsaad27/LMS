<?php

namespace App\Interfaces;

use App\Api\Requests\PublishingHouseRequests\StorePublishingHouseRequest;
use App\Api\Requests\PublishingHouseRequests\UpdatePublishingHouseRequest;
use Illuminate\Http\Request;

interface PublishingHouseInterface
{
    public function index();
    public function create();
    public function store(StorePublishingHouseRequest $request);
    public function show($id);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy($id);
}
