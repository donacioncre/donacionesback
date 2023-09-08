<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
class SeaderTablePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'eliminar-rol',

            'ver-horarioDonacion',
            'crear-horarioDonacion',
            'editar-horarioDonacion',
            'eliminar-horarioDonacion',

            'ver-ciudad',
            'crear-ciudad',
            'editar-ciudad',
            'eliminar-ciudad',

            'ver-convocatoria',
            'crear-convocatoria',
            'editar-convocatoria',
            'eliminar-convocatoria',

            'ver-pais',
            'crear-pais',
            'editar-pais',
            'eliminar-pais',

            'ver-centroDonacion',
            'crear-centroDonacion',
            'editar-centroDonacion',
            'eliminar-centroDonacion',

            'ver-historialDonacion',
            'crear-historialDonacion',
            'editar-historialDonacion',
            'eliminar-historialDonacion',

            'ver-noticias',
            'crear-noticias',
            'editar-noticias',
            'eliminar-noticias',

            'ver-preguntas',
            'crear-preguntas',
            'editar-preguntas',
            'eliminar-preguntas',

            'ver-agenda',
            'crear-agenda',
            'editar-agenda',
            'eliminar-agenda',

            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'eliminar-usuario',

            'ver-beneficios',
            'crear-beneficios',
            'editar-beneficios',
            'eliminar-beneficios',

            'ver-requerimientos',
            'crear-requerimientos',
            'editar-requerimientos',
            'eliminar-requerimientos',

            'ver-mitos',
            'crear-mitos',
            'editar-mitos',
            'eliminar-mitos',
        ];

        foreach($permissions as $permission){
            Permission::create(['name'=>$permission]);
        }

        $roles=[
             'admin',
             'user',
             'donante'
        ];

         foreach($roles as $rol){
             Role::create(['name'=>$rol]);
         }

         $user = new User([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234'),
            'firstname' => 'admin',
            'lastname' => 'admin',
            'identification' =>'12345',
            'phone_number' =>'12345',
            'date_birth' => '1992-07-18',
            'blood_type' => 'o',
            'profile_picture' =>'N/A',
        ]);

        $user->assignRole('admin');
        $user->save();
    }
}
