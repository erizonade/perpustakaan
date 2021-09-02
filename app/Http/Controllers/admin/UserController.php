<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
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

            $columns = ['id', 'name', 'username', 'role', 'status', 'id'];


            $totalData = User::count();
            $totalFiltered = $totalData;

            $search       = $request['search']['value'];
            $limit_Start  = $request['start'];
            $limit_Length = $request['length'];
            $order_col    = $columns[$request['order'][0]['column']];
            $order_dir    = $request['order'][0]['dir'];

            $user = User::select('*');

            if (!empty($search)) {
                $user->whereRaw('(name LIKE  "%' . $search . '%")');
            }

            $totalFiltered = $user->count();
            $users = $user->offset($limit_Start)
                ->limit($limit_Length)
                ->orderBy($order_col, $order_dir)
                ->get();


            $data = array();
            $no = $limit_Start + 1;
            foreach ($users as $res) {
                $data[] = array(
                    $no++,
                    $res->name,
                    $res->username,
                    ($res->role == 'A' ? 'Admin' : 'Guest'),
                    '<button class="btn btn-sm ' . ($res->status == 0 ? 'btn-danger' : 'btn-success') . ' " >' . ($res->status == 0 ? 'Tidak Aktif' : 'Aktif') . '</button>',
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
                    'message' => 'User book',
                    'data'    => $dataTable
                ]
            ];

            return response()->json($response);
        }
        return view('/admin/user')->with('activeTab', 'data-user');
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
            'name'       => 'required',
            'username'   => 'required|unique:users,username',
            'password'   => 'required|min:6',
            'status'     => 'required',
            'role'       => 'required',
        ];

        $msg = [
            'required' => 'Wajib Di Isi',
            'numeric'  => 'Hanya Bisa Angka',
            'unique'   => 'Judul Sudah Ada',
            'min'      => 'Minimal 6 Karakter'
        ];

        $request->validate($rules, $msg);

        $data['name']       = $request->name;
        $data['username']   = $request->username;
        $data['password']   = bcrypt($request->password);
        $data['role']       = $request->role;
        $data['status']     = $request->status;
        $data['created_at'] = Carbon::now();

        User::insert($data);

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
        $data  = User::find($id);
        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Edit',
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
            'name'       => 'required',
            'username'   => 'required|unique:users,username,' . $id . ',id',
            'status'     => 'required',
            'role'       => 'required',
        ];

        if (!empty($request->password)) {
            $rules = [
                'password'   => 'required|min:6'
            ];
        }

        $msg = [
            'required' => 'Wajib Di Isi',
            'numeric'  => 'Hanya Bisa Angka',
            'unique'   => 'Judul Sudah Ada',
            'min'      => 'Minimal 6 Karakter'
        ];

        $request->validate($rules, $msg);

        $data['name']       = $request->name;
        $data['username']   = $request->username;

        if (!empty($request->password)) {
            $data['password']   = bcrypt($request->password);
        }
        $data['role']       = $request->role;
        $data['status']     = $request->status;
        $data['created_at'] = Carbon::now();

        User::where('id', $id)->update($data);

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Success Created Data'
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

        User::where('id', $id)->delete();

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Success Delete Data'
            ]
        ];

        return response()->json($response);
    }
}
