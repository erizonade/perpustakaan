<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CreatorBooks;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreatorBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $columns = ['id', 'name', 'id'];


            $totalData = CreatorBooks::count();
            $totalFiltered = $totalData;

            $search       = $request['search']['value'];
            $limit_Start  = $request['start'];
            $limit_Length = $request['length'];
            $order_col    = $columns[$request['order'][0]['column']];
            $order_dir    = $request['order'][0]['dir'];

            $creator = CreatorBooks::select('*');

            if (!empty($search)) {
                $creator->whereRaw('(name LIKE  "%' . $search . '%")');
            }

            $totalFiltered = $creator->count();
            $creators = $creator->offset($limit_Start)
                ->limit($limit_Length)
                ->orderBy($order_col, $order_dir)
                ->get();


            $data = array();
            $no = $limit_Start + 1;
            foreach ($creators as $res) {
                $data[] = array(
                    $no++,
                    $res->name,
                    '<button class="btn btn-sm btn-info edit" data-id="' . $res->id . '">Edit</button>
                    <button class="btn btn-sm btn-danger delete" data-id="' . $res->id . '">Delete</button>'
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
        return view('/admin/creator_book')->with('activeTab', 'data-creator_book');
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
            'name' => 'required',
        ];

        $msg = [
            'name.required' => 'Name Creator Wajib Di Isi',
        ];

        $request->validate($rules, $msg);

        $data['name']       = $request->name;
        $data['created_at'] = Carbon::now();

        CreatorBooks::insert($data);

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
        $data = CreatorBooks::find($id);

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
            'name' => 'required',
        ];

        $msg = [
            'name.required' => 'Name Creator Wajib Di Isi',
        ];

        $request->validate($rules, $msg);

        $data['name']       = $request->name;
        $data['updated_at'] = Carbon::now();

        CreatorBooks::where('id', $id)->update($data);

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

        CreatorBooks::where('id', $id)->delete();

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Success Delete Data'
            ]
        ];

        return response()->json($response);
    }
}
