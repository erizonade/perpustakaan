<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\CreatorBooks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        //
        if ($request->ajax()) {

            $columns = ['id_creator', 'name', 'titel', 'publication_year', 'creator_id'];


            $totalData = Books::selectRaw('*')->leftjoin('book_creator as bc', 'bc.id', 'books.creator_id')->count();
            $totalFiltered = $totalData;

            $search       = $request['search']['value'];
            $limit_Start  = $request['start'];
            $limit_Length = $request['length'];
            $order_col    = $columns[$request['order'][0]['column']];
            $order_dir    = $request['order'][0]['dir'];

            $bookss = Books::selectRaw('*,bc.id as id_creator,books.id as id_book')->leftjoin('book_creator as bc', 'bc.id', 'books.creator_id');

            if (!empty($search)) {
                $bookss->whereRaw('(name LIKE  "%' . $search . '%" OR title LIKE  "%' . $search . '%")');
            }

            $totalFiltered = $bookss->count();
            $booksss = $bookss->offset($limit_Start)
                ->limit($limit_Length)
                ->orderBy($order_col, $order_dir)
                ->get();


            $data = array();
            $no = $limit_Start + 1;
            foreach ($booksss as $res) {
                $data[] = array(
                    $no++,
                    '<img width="50px" src="/data/images/' . $res->foto . '">',
                    $res->name,
                    $res->title,
                    $res->publication_year,
                    '<button class="btn btn-sm ' . ($res->status == 0 ? 'btn-danger' : 'btn-success') . ' " >' . ($res->status == 0 ? 'Tidak Aktif' : 'Aktif') . '</button>',
                    '<button class="btn btn-sm btn-info edit" data-id="' . $res->id_book . '">Edit</button>
                    <button class="btn btn-sm btn-danger delete" data-id="' . $res->id_book . '">Delete</button>'
                );
            }

            $dataTable = [];
            $dataTable['draw']            = $request['draw'];
            $dataTable['recordsTotal']    = $totalData;
            $dataTable['recordsFiltered'] = $totalFiltered;
            $dataTable['data']            = $data;


            $response = [
                'response' => [
                    'success' => 200,
                    'message' => 'Creator book',
                    'data'    => $dataTable
                ]
            ];

            return response()->json($response);
        }

        $creator = CreatorBooks::get();

        return view('/admin/book', compact('creator'))->with('activeTab', 'data-book');;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'creator_id'       => 'required',
            'foto'             => 'required|image|mimes:jpeg,png,jpg|max:200',
            'title'            => 'required|unique:books,title',
            'publication_year' => 'required|numeric',
            'status'           => 'required',
        ];

        $msg = [
            'required' => 'Wajib Di Isi',
            'numeric'  => 'Hanya Bisa Angka',
            'unique'   => 'Judul Sudah Ada',
            'mimes'    => 'Hanya Bisa berupa Gambar',
            'max'      => 'Maximal 200KB',
        ];

        $request->validate($rules, $msg);

        $folder = 'data/images/';
        if ($request->hasFile('foto')) {
            $foto_file = $request->file('foto');
            $fotos = time() . "." . $foto_file->getClientOriginalExtension();
        }

        if ($request->hasFile('foto')) {
            $foto_file->move($folder, $fotos);
        }

        $data['creator_id']        = $request->creator_id;
        $data['title']             = $request->title;
        $data['foto']              = $fotos;
        $data['publication_year']  = $request->publication_year;
        $data['status']            = $request->status;
        $data['created_at'] = Carbon::now();

        Books::insert($data);

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Success Created Data'
            ]
        ];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $data = Books::find($id);

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Data',
                'data'    => $data
            ]
        ];

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $rules = [
            'creator_id'       => 'required',
            'title'            => 'required|unique:books,title,' . $id . ',id',
            'publication_year' => 'required|numeric',
            'status'           => 'required',
        ];

        $msg = [
            'required' => 'Wajib Di Isi',
            'numeric'  => 'Hanya Bisa Angka',
            'unique'   => 'Judul Sudah Ada',
        ];


        $request->validate($rules, $msg);

        $folder = 'data/images/';
        if ($request->hasFile('foto')) {
            $foto_file = $request->file('foto');
            $fotos = time() . "." . $foto_file->getClientOriginalExtension();
        }

        $book_olds = Books::find($id);
        $foto_lama = $book_olds->foto;

        if ($request->hasFile('foto')) {
            $foto_file->move($folder, $fotos);
            File::delete($folder . $foto_lama);
        }

        $data['creator_id']        = $request->creator_id;
        $data['title']             = $request->title;
        $data['foto']              = (empty($fotos) ? $foto_lama : $fotos);
        $data['publication_year']  = $request->publication_year;
        $data['status']            = $request->status;
        $data['updated_at'] = Carbon::now();

        Books::where('id', $id)->update($data);

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Success Updated Data'
            ]
        ];

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        Books::where('id', $id)->delete();

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Success Delete Data'
            ]
        ];

        return response()->json($response);
    }
}
