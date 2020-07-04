<?php

namespace App\Http\Controllers\view;
set_time_limit(0);
use Validator;

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use PDO;


class ViewController extends Controller
{
    private $db;
    private $table;
    private $field;
    private $condition;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        list($found, $routeInfo, $params) = $request->route() ?: [false, [], []];

        $this->db = isset($params['db']) ? $params['db'] : null ;
        $this->table = isset($params['table']) ? $params['table'] : null ;
        $this->field = isset($params['field']) ? $params['field'] : null ;
        $this->condition = isset($params['condition']) ? $params['condition'] : null ;


        $this->connect($this->db);
    }


    public function astguDB()
    {
        $this->db = 'astgu';
        $this->connect($this->db);
    }



    /**
     * Recovery Password
     */
    public function estadoCuenta(Request $request)
    {

        $this->validate($this->request, [
            'idGente'     => 'required'
        ]);

        $idGente = $request->input('idGente');

        if (view()->exists('report.estadoCuenta')) {

            //Log::info('encontro view');

            return view(
                'report.estadoCuenta',[
                    'idGente' => $idGente
                ]
            );

        } else {
            $msj['success'] = false;
            $msj['status'] = false;
            $msj['msg'] = 'view email not found';

            return $msj;
        }


    }

    /**
     * Recovery Password
     */
    public function login(Request $request)
    {

        if (view()->exists('login')) {

            //Log::info('encontro view');

            return view(
                'login',[]
            );

        } else {
            $msj['success'] = false;
            $msj['status'] = false;
            $msj['msg'] = 'view email not found';

            return $msj;
        }


    }

    public function register(Request $request)
    {

        if (view()->exists('register')) {

            //Log::info('encontro view');

            return view(
                'register',[]
            );

        } else {
            $msj['success'] = false;
            $msj['status'] = false;
            $msj['msg'] = 'view email not found';

            return $msj;
        }


    }


    public function informacion(Request $request)
    {

        if (view()->exists('information')) {

            //Log::info('encontro view');

            return view(
                'information',[]
            );

        } else {
            $msj['success'] = false;
            $msj['status'] = false;
            $msj['msg'] = 'view  not found';

            return $msj;
        }


    }

    public function salir(Request $request)
    {

        session_destroy();
        return redirect('/');


    }

}
