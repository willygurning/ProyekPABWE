<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Author;
use App\Book;

class DataController extends Controller
{
    public function authors()
     {

        $authors=Author::orderBy('name', 'ASC');

        return datatables()->of($authors)
                ->addColumn('action', 'admin.author.action')
                ->addIndexColumn()
                ->toJson();
    }

    public function books()
     {

        $books=Book::orderBy('title', 'ASC');

        return datatables()->of($books)
                ->addColumn('author', function(book $model){
                    return $model->author->name;
                })
                ->editColumn('cover', function (book $model){
                    return '<img src="'. $model->getCover() .'" height="150px" >';
                })
                ->addColumn('action', 'admin.book.action')
                ->addIndexColumn()
                ->rawColumns(['cover','action'])
                ->toJson();
    }
}

 