<?php

use Illuminate\Database\Seeder;

use App\RazonSocial;

class razon_social_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RazonSocial::create([
            'codigo' => 'C0001',
            'nombre' => 'U.E. NOMBRE PRUEBA',
            'alias' => 'CP',
            'nro_resolucion' => '111000000',
            'codigo_sie' => '11111',
            'tipo_ue' => 'PRIVADO',
            'ciudad' => 'LA PAZ',
            'nro_distrito' => '6',
            'desc_distrito' => 'DISTRITO',
            'dir' => 'ZONA LOS OLIVOS CALLE 3 #3232',
            'nit' => '100000552132',
            'nro_aut' => '100000005566',
            'fono' => '21134568',
            'cel' => '78945612',
            'casilla' => '',
            'correo' => '',
            'web' => '',
            'logo' => 'logo.png',
            'actividad_economica' => 'ACTIVIDAD ECONOMICA',
        ]);
    }
}
