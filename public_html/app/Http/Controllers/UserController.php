<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Municipio;
use App\Models\DatoUsuario;
use App\Models\Departamento;
use App\Mail\RutaCMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Repositories\FormRepository;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    private $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FormRepository $repository)
    {
        $this->middleware('user');
        $this->repository = $repository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function miPerfil()
    {
        $usuario = Auth::user()->datoUsuario;
        $empresas = Auth::user()->empresas->first();
        $emprendimientos = Auth::user()->emprendimientos->first();
        $repositoryDepartamentos = $this->repository->departamentos();
        $repository = $this->repository;
        $from = "actualizar";
        if($usuario){
            return view('rutac.usuario.perfil',compact('usuario','empresas','emprendimientos','repositoryDepartamentos','repository','from'));    
        }
        return redirect()->action('HomeController@index');
    }

    public function configuracion()
    {
        return view('rutac.usuario.configuracion');
    }

    public function showFormCompletarPerfil(){
        $usuario = Auth::user()->datoUsuario;
        $empresas = Auth::user()->empresas->first();
        $emprendimientos = Auth::user()->emprendimientos->first();
        $repositoryDepartamentos = $this->repository->departamentos();
        $repository = $this->repository;
        $from = "perfil";

        return view('rutac.usuario.completar-perfil',compact('usuario','repositoryDepartamentos','repository','empresas','emprendimientos','from'));
    }

    public function guardarPerfil(Request $request){
        $rules = [

        ];
        $validator = Validator::make($request->all(), $rules);

        $data = [];
        $data['status'] = '';
        if($validator->fails()){
            $errors = $validator->errors();
            $data['status'] = 'Errors';
            foreach($rules as $key => $value){
                $data['errors'][$key] = $errors->first($key);                              
            }
        }else{
            if($data['status'] != 'Errors'){
                $datoUsuario = DatoUsuario::where('dato_usuarioID',Auth::user()->dato_usuarioID)->first();
                $datoUsuario->dato_usuarioNOMBRE_COMPLETO = $request->nombre_completo;
                $datoUsuario->dato_usuarioDIRECCION = $request->direccion;
                $datoUsuario->dato_usuarioDEPARTAMENTO_RESIDENCIA = $this->obtenerDepartamento($request->departamento_residencia);
                if($request->municipio_residencia){
                    $datoUsuario->dato_usuarioMUNICIPIO_RESIDENCIA = $this->obtenerMunicipio($request->municipio_residencia);
                }
                $datoUsuario->dato_usuarioTELEFONO = $request->telefono;
                $datoUsuario->dato_usuarioSEXO = $request->genero;
                $datoUsuario->dato_usuarioFECHA_NACIMIENTO = $request->fecha_nacimiento;
                $datoUsuario->dato_usuarioDEPARTAMENTO_NACIMIENTO = $this->obtenerDepartamento($request->departamento_nacimiento);
                if($request->municipio_nacimiento){
                    $datoUsuario->dato_usuarioMUNICIPIO_NACIMIENTO = $this->obtenerMunicipio($request->municipio_nacimiento);
                }
                $datoUsuario->dato_usuarioNIVEL_ESTUDIO = $request->nivel_estudios;
                $datoUsuario->dato_usuarioPROFESION_OCUPACION = $request->profesion;
                $datoUsuario->dato_usuarioCARGO = $request->cargo;
                $datoUsuario->dato_usuarioREMUNERACION = $request->remuneracion;
                $datoUsuario->dato_usuarioGRUPO_ETNICO = $request->grupo_etnico;
                $datoUsuario->dato_usuarioDISCAPACIDAD = $request->discapacidad;
                if($request->idiomas){
                    $datoUsuario->dato_usuarioIDIOMAS = $this->obtenerIdiomas($request->idiomas);
                }
                $datoUsuario->save();

                $data['status'] = 'Ok';
            }
        }
        if($request->from == 'actualizar'){
            $request->session()->flash("message_success", "Datos actualizados correctamente");
            return back();
        }
        return json_encode($data);
    }

    public function actualizarPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'anterior_password' => 'required',
            'nuevo_password' => 'required',
            'repetir_password'    => 'required'
        ]);

        if ($validator->fails()) {
            $request->session()->flash("tab_active", "actualizar-password");
            $request->session()->flash("message_error", "Digite todos los datos");
            return back();
        }

        if (Auth::attempt(['usuarioID' => Auth::user()->usuarioID, 'password' => $request->anterior_password])) {
            if($request->input('nuevo_password') == $request->input('repetir_password')){
                if(strlen ($request->input('nuevo_password'))>=8){
                    DB::table('usuarios')
                            ->where('usuarioID', Auth::user()->usuarioID)
                            ->update(['password' => bcrypt($request->input('nuevo_password'))]);
                    $request->session()->flash("message_success", "Contraseña guardada correctamente");
                    return back();
                }else{
                    $request->session()->flash("tab_active", "actualizar-password");
                    $request->session()->flash("message_error", "La contraseña debe tener al menos 8 caracteres");
                return back();
                }
            }else{
                $request->session()->flash("tab_active", "actualizar-password");
                $request->session()->flash("message_error", "Las contraseñas no coinciden");
                return back();
            }
        }
        else{
            $request->session()->flash("tab_active", "actualizar-password");
            $request->session()->flash("message_error", "La contraseña no coincide");
            return back();
        }
    }
    
    public function reenviarCodigo(Request $request){
        $usuario = User::where('usuarioID',Auth::user()->usuarioID)->first();
        if($usuario){
            $usuario->confirmation_code = str_random(25);
            $usuario->save();

            Mail::send(new RutaCMail($usuario, 'reenvio_codigo'));

            $request->session()->flash("message_success", "Código enviado correctamente. Revisa tu correo, sigue el enlace y accede a todas las funciones de Ruta C ");
            return back();
        }
        $request->session()->flash("message_error", "Ocurrió un error, intente nuevamente");
        return back();
    }

    public function buscarMunicipios($departamento){
        $repository = $this->repository->municipios($departamento);
        return $repository;
    }

    public function obtenerDepartamento($departamento){
        $departamento = Departamento::where('id_departamento',$departamento)->select('departamento')->first();
        if($departamento){
            return $departamento->departamento;    
        }
        return "";
        
    }
    public function obtenerMunicipio($municipio){
        $municipio = Municipio::where('id_municipio',$municipio)->select('municipio')->first();
        if($municipio){
            return $municipio->municipio;    
        }
        return "";
    }

    public function obtenerIdiomas($idiomas){
        $sIdiomas = "";
        if($idiomas){
            foreach ($idiomas as $key => $idioma) {
                if($sIdiomas==""){
                    $sIdiomas = $idioma;
                }else{
                    $sIdiomas = $sIdiomas."-".$idioma;
                }
            }
        }
        return $sIdiomas;
    }
}