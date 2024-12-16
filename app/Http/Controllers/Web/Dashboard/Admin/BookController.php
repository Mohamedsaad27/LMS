<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequests\StoreBookRequest;
use App\Http\Requests\BookRequests\UpdateBookRequest;
use App\Services\Interfaces\Dashboard\Admin\BookRepositoryInterface;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        $books = $this->bookRepository->index();
        return view('dashboard.admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = $this->bookRepository->create();
        return view('dashboard.admin.books.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $this->bookRepository->store($request);
        return redirect()->route('books.index')->with('success', trans('messages.book_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book = $this->bookRepository->show($book);
        return view('dashboard.admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $subjects = $this->bookRepository->edit($book);
        return view('dashboard.admin.books.edit', compact('book', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->bookRepository->update($request, $book);
        return redirect()->route('books.index')->with('success', trans('messages.book_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->bookRepository->destroy($book);
        return redirect()->route('books.index')->with('success', trans('messages.book_deleted'));
    }
}
