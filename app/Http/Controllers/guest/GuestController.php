<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //
    function index()
    {
        $book = Books::join('book_creator as bc', 'bc.id', 'books.creator_id')->where('status', '1')->get();
        return view('/guest/dashboard', compact('book'));
    }

    function filter_book($search)
    {
        $bookss = Books::selectRaw('*,bc.id as id_creator,books.id as id_book')->leftjoin('book_creator as bc', 'bc.id', 'books.creator_id')
            ->whereRaw('(name LIKE  "%' . $search . '%" OR title LIKE  "%' . $search . '%")')
            ->get();


        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Success Created Data',
                'data'    => $bookss
            ]
        ];

        return response()->json($response);
    }
}
