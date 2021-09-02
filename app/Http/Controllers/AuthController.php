<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    function index()
    {
        return view('auth/login');
    }

    function login(Request $request)
    {

        $rules = [
            'username' => 'required',
            'password' => 'required|min:6'
        ];

        $msg = [
            'username.required' => 'Username Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi',
            'min'               => 'Password Minimal 6 Karakter'
        ];

        $request->validate($rules, $msg);


        // 

        $username = $request->username;
        $password = $request->password;


        $user = User::where('username', $username)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                if ($user->status == 1) {
                    $session = [
                        'id'         => $user->id,
                        'name'       => $user->name,
                        'role'       => $user->role,
                        'login_time' => date('H:i:s')
                    ];

                    Session::put('user', $session);
                    if ($user->role == 'A') {

                        $response = [
                            'response' => [
                                'success'   => 200,
                                'message' => 'Berhasil Login',
                                'url'     => '/admin'
                            ]
                        ];
                    } else if ($user->role == 'G') {
                        $response = [
                            'response' => [
                                'success'   => 200,
                                'message' => 'Berhasil Login',
                                'url'     => '/guest'
                            ]
                        ];
                    }
                } else {
                    $response = [
                        'response' => [
                            'error'   => 401,
                            'message' => 'Akun Tidak Aktif'
                        ]
                    ];
                }
            } else {
                $response = [
                    'response' => [
                        'error'   => 401,
                        'message' => 'Password Salah'
                    ]
                ];
            }
        } else {
            $response = [
                'response' => [
                    'error'   => 401,
                    'message' => 'Username Tidak Ada'
                ]
            ];
        }

        return response()->json($response);
    }

    function profil()
    {
        return view('/auth/resetpassword')->with('activeTab', 'data-profil');;
    }

    function reset_password(Request $request)
    {
        $rules = [
            'password'   => 'required|min:6',
        ];

        $msg = [
            'required' => 'Wajib Di Isi',
            'min'      => 'Minimal 6 Karakter'
        ];

        $request->validate($rules, $msg);

        $data['password']   = bcrypt($request->password);
        $data['updated_at'] = Carbon::now();

        $id = Session::get('user')['id'];

        User::where('id', $id)->update($data);

        $response = [
            'response' => [
                'success' => '200',
                'message' => 'Success Update Password'
            ]
        ];

        return response()->json($response);
    }

    function logout()
    {
        Session::forget('user');
        return redirect('/');
    }
}
