<?php

namespace App\Api\Controllers;

use App\Api\Requests\PublishingHouseRequests\StorePublishingHouseRequest;
use App\Api\Requests\PublishingHouseRequests\UpdatePublishingHouseRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\PublishingHouseInterface;
use Illuminate\Http\Request;

class PublishingHouseController extends Controller
{
    protected $publishingHouse;
    public function __construct(PublishingHouseInterface $publishingHouse)
    {
        $this->publishingHouse = $publishingHouse;
    }


    public function index()
    {
        return $this->publishingHouse->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->publishingHouse->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePublishingHouseRequest $request)
    {
        return $this->publishingHouse->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->publishingHouse->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->publishingHouse->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->publishingHouse->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->publishingHouse->destroy($id);

    }
}
