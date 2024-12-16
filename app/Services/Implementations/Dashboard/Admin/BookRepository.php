<?php

namespace App\Services\Implementations\Dashboard\Admin;

use App\Http\Requests\BookRequests\StoreBookRequest;
use App\Http\Requests\BookRequests\UpdateBookRequest;
use App\Models\Book;
use App\Services\Interfaces\Dashboard\Admin\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function index()
    {
        $books = $this->book->with('subject')->get();
        return $books;
    }

    public function create()
    {
        $subjects = $this->book->subject->get();
        return $subjects;
    }

    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'Uploads/books/' . $imageName;
            $image->move(public_path('Uploads/books'), $imageName);
            $validated['cover_image'] = $imagePath;
        }
        $book = $this->book->create($validated);
        return $book;
    }

    public function show(Book $book)
    {
        $book = $this->book->with('subject')->find($book->id);
        return $book;
    }

    public function edit(Book $book)
    {
        $subjects = $this->book->subject->get();
        return $subjects;
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $validated = $request->validated();
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'Uploads/books/' . $imageName;
            $image->move(public_path('Uploads/books'), $imageName);
            $validated['cover_image'] = $imagePath;
        }
        $book->update($validated);
        return $book;
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return true;
    }
}
