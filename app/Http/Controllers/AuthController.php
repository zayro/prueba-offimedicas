<?php

namespace App\Http\Controllers;

use Validator;
use Log;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;

//use Illuminate\Support\Facades\Log;

use zayro\src\Controllers\library\encrypt;

use Dotenv\Dotenv;

use PDO;

class AuthController extends Controller
{
    private $db;
    private $table;
    private $field;
    private $condition;

    private static $secret_key = null;
    private static $encrypt = ['HS256'];
    private static $aud = null;


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
        self::$secret_key = env('JWT_SECRET');

        $this->request = $request;

        list($found, $routeInfo, $params) = $request->route() ?: [false, [], []];

        $this->db = getenv('DB_DATABASE');
        $this->table = isset($params['table']) ? $params['table'] : null ;
        $this->field = isset($params['field']) ? $params['field'] : null ;
        $this->condition = isset($params['condition']) ? $params['condition'] : null ;


        $this->connect($this->db);
    }



    /**
     * Create a new token.
     *
     * @param  \App\User   $user
     * @return string
     */
    protected function jwt($data)
    {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'aud' => "lumen-jwt", // Issuer of the token
            'iat' => time() , // Time when JWT was issued.
            #'nbf' => time() + 1, //  Timestamp of when the token should start being considered valid.
            #'exp' => time() + ((60*60) * 4), // Expiration time 4 hours,
            'exp' => (time() +  (4 * 60 * 60)), // Expiration time 4 hours,
            'sub' => $data,
            'data' => $data
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @param  \App\User   $user
     * @return mixed
     */

    public function authenticate(Request $request)
    {

        //Log::info('Showing user profile for user: ');

        $this->validate($this->request, [
            'usuario'     => 'required',
            'password'  => 'required'
        ]);
        // Find the user by email
        $from  = 'usuarios';

        $user = $request->input('usuario');
        $password = $request->input('password');

        $sql = "SELECT * from $from where (usuario =  '$user' ) ";

        $result = $this->database->query($sql)->fetchAll(PDO::FETCH_OBJ);

        $count = method_exists($result, 'rowCount') ? $result->rowCount() : count($result);

        foreach ($result as $row) {
            $passwordSql = $row->password;
        }

        if ($count > 0) {

            // Verify the password and generate the token
            if (Hash::check($password, $passwordSql)) {

                $token = $this->jwt($result);

                $_SESSION['token'] =  $token;


                return response()->json([
                    'status' => true,
                    'message' => "Auth Success",
                    'result' => $result,
                    'token' => $token
                ], 200);
            } else {

                // Bad Request response
                return response()->json([
                'error' => 'password is wrong.',
                'pass' => $password
            ], 400);
            }
        } else {
            return response()->json([
                    'status' => false,
                    'result' => $this->database->log(),
                    'message' => "Auth Denid User",
                    'count' => "$count"
                ], 401);
        }
    }


     /**
     * Registro Usuario
     */
    public function register(Request $request)
    {
        $this->validate($this->request, [
            'usuario'  => 'required',
            'password'  => 'required',
            'identificacion'  => 'required'
        ]);

        $save = [];

        $save['usuario'] = $request->input('usuario');
        $save['password'] = Hash::make($request->input('password'));
        $save['identificacion'] = $request->input('identificacion');
        $save['nombres'] = $request->input('nombres');
        $save['apellidos'] = $request->input('apellidos');
        $save['email'] = $request->input('email');


        $result = $this->database->insert("usuarios", $save);


        if ($result->rowCount() > 0) {
               return response()->json([
                'status' => true,
                'message' => "Auth Created"
            ], 201);
        } else {
            $msj['success'] = false;
            $msj['status'] = false;
            $msj['error'] = $this->database->error();
            return $msj;
        }
    }




    private static function Aud()
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }

    public static function GetData($token)
    {
        return JWT::decode(
            $token,
            env('JWT_SECRET'),
            self::$encrypt
        )->data;
    }

    public function Check(Request $request)
    {
        $token = $request->input('token');

        if (empty($token)) {
            throw new Exception("Invalid token supplied.");
        }


        /*         if($decode->aud !== self::Aud())
        {
            throw new Exception("Invalid user logged in.");
        } */

        try {
            $decode = JWT::decode(
                $token,
                env('JWT_SECRET'),
                ['HS256']
            )->data;

            return response()->json([
                'exitos' => 'token valido.',
                'data' => $decode
            ], 200);
        } catch (ExpiredException $e) {
            return response()->json([
                'error' => 'Provided token is expired.'
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error while decoding token.',
                'token' => $token,
            ], 400);
        }
    }
}
