<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Models\Book;
use App\Http\Requests\BookRequests\StoreBookRequest;
use App\Http\Requests\BookRequests\UpdateBookRequest;

interface BookRepositoryInterface
{
    public function index();
    public function create();
    public function store(StoreBookRequest $request);
    public function show(Book $book);
    public function edit(Book $book);
    public function update(UpdateBookRequest $request, Book $book);
    public function destroy(Book $book);
}
