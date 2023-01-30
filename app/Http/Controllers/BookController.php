<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
	/**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $books = Book::orderBy('id','desc')->paginate(5);
        return view('books.index', compact('books'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('books.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
			'subtitle' => 'required',
            'author' => 'required',
			'isbn' => 'required',
        ]);
        
        Book::create($request->post());

        return redirect()->route('books.index')->with('success','Book has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\book  $book
    * @return \Illuminate\Http\Response
    */
    public function show(Book $book)
    {
        return view('books.show',compact('book'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Book  $book
    * @return \Illuminate\Http\Response
    */
    public function edit(Book $book)
    {
        return view('books.edit',compact('book'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\book  $book
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
			'subtitle' => 'required',
            'author' => 'required',
			'isbn' => 'required',
        ]);
        
        $book->fill($request->post())->save();

        return redirect()->route('books.index')->with('success','Book Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Book  $book
    * @return \Illuminate\Http\Response
    */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success','Book has been deleted successfully');
    }
}
