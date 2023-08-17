<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public static function nombreUsuario($nom, $apep, $apem)
    {
        //determinando el nombre de usuario inicial del 1er_nombre+apep+tipoUser
        $nombre_user = substr(mb_strtoupper($nom), 0, 1); //inicial 1er_nombre
        $nombre_user .= substr(mb_strtoupper($apep), 0, 1); //inicial 1er_nombre
        if ($apem) {
            $nombre_user .= substr(mb_strtoupper($apem), 0, 1); //inicial 1er_nombre
        }

        return $nombre_user;
    }

    // VISTA CONFIGURACIÓN DE USUARIO
    public function config(User $user)
    {
        return view('users.config', compact('user'));
    }

    // NUEVA CONTRASEÑA POR USUARIOS
    public function cuenta_update(Request $request, User $user)
    {
        if ($request->oldPassword) {
            if (Hash::check($request->oldPassword, $user->password)) {
                if ($request->newPassword == $request->password_confirm) {
                    $user->password = Hash::make($request->newPassword);
                    $user->save();
                    return redirect()->route('users.config', $user->id)->with('bien', 'Contraseña actualizada con éxito');
                } else {
                    return redirect()->route('users.config', $user->id)->with('error', 'Error al confirmar la nueva contraseña');
                }
            } else {
                return redirect()->route('users.config', $user->id)->with('error', 'La contraseña (Antigua contraseña) no coincide con nuestros registros');
            }
        }
    }

    // NUEVA FOTO POR USUARIOS
    public function cuenta_update_foto(Request $request, User $user)
    {
        if ($request->ajax()) {
            if ($request->hasFile('foto')) {
                $archivo_img = $request->file('foto');
                $extension = '.' . $archivo_img->getClientOriginalExtension();
                $codigo = $user->name;
                $path = public_path() . '/imgs/users/' . $user->foto;
                if ($user->foto != 'user_default.png') {
                    \File::delete($path);
                }
                // SUBIENDO FOTO AL SERVIDOR
                if ($user->empleado) {
                    $name_foto = $codigo . $user->empleado->nombre . time() . $extension; //determinar el nombre de la imagen y su extesion
                } else {
                    $name_foto = $codigo . time() . $extension; //determinar el nombre de la imagen y su extesion
                }
                $name_foto = str_replace(' ', '_', $name_foto);
                $archivo_img->move(public_path() . '/imgs/users/', $name_foto); //mover el archivo a la carpeta de destino

                $user->foto = $name_foto;

                if ($user->administrativo) {
                    $user->administrativo->foto = $name_foto;
                    $user->administrativo->save();
                }

                if ($user->profesor) {
                    $user->profesor->foto = $name_foto;
                    $user->profesor->save();
                }

                if ($user->estudiante) {
                    $user->estudiante->foto = $name_foto;
                    $user->estudiante->save();
                }

                $user->save();
                session(['bien' => 'Foto actualizado con éxito']);
                return response()->JSON([
                    'msg' => 'actualizado'
                ]);
            }
        }
    }
}
