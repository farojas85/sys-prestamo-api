<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::select('id')->where('slug','super-usuario')->first();
        $role2 = Role::select('id')->where('slug','gerente')->first();
        $role3 = Role::select('id')->where('slug','lider-superior')->first();
        $role4 = Role::select('id')->where('slug','lider')->first();
        $role5 = Role::select('id')->where('slug','inversionista')->first();

        //Tipo Acceso
        $permiso1 = Permiso::firstOrCreate([
            'nombre' => 'Vista Tipo Acceso','slug' => 'tipo-accesos.inicio'
        ])
        ;
        $permiso2 = Permiso::firstOrCreate([
            'nombre' => 'Crear Tipo Acceso','slug' => 'tipo-accesos.crear'
        ])
        ;
        $permiso3 = Permiso::firstOrCreate([
            'nombre' => 'Editar Tipo Acceso','slug' => 'tipo-accesos.editar'
        ])
        ;
        $permiso4 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Tipo Acceso','slug' => 'tipo-accesos.eliminar'
        ])
        ;
        $permiso5 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Tipo Acceso','slug' => 'tipo-accesos.restaurar'
        ])
        ;
        //Role
        $permiso6 = Permiso::firstOrCreate([
            'nombre' => 'Vista Rol','slug' => 'roles.inicio'
        ])
        ;
        $permiso7 = Permiso::firstOrCreate([
            'nombre' => 'Crear Rol','slug' => 'roles.crear'
        ])
        ;
        $permiso8 = Permiso::firstOrCreate([
            'nombre' => 'Editar Rol','slug' => 'roles.editar'
        ])
        ;
        $permiso9 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Rol','slug' => 'roles.eliminar'
        ])
        ;
        $permiso10 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Rol','slug' => 'roles.restaurar'
        ])
        ;
        //Usuario
        $permiso11 = Permiso::firstOrCreate([
            'nombre' => 'Vista Usuario','slug' => 'usuarios.inicio'
        ])
        ;
        $permiso12 = Permiso::firstOrCreate([
            'nombre' => 'Crear Usuario','slug' => 'usuarios.crear'
        ])
        ;
        $permiso13 = Permiso::firstOrCreate([
            'nombre' => 'Editar Usuario','slug' => 'usuarios.editar'
        ])
        ;
        $permiso14 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Usuario','slug' => 'usuarios.eliminar'
        ])
        ;
        $permiso15 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Usuario','slug' => 'usuarios.restaurar'
        ])
        ;
        //Permiso
        $permiso16 = Permiso::firstOrCreate([
            'nombre' => 'Vista Permiso','slug' => 'permisos.inicio'
        ])
        ;
        $permiso17 = Permiso::firstOrCreate([
            'nombre' => 'Crear Permiso','slug' => 'permisos.crear'
        ])
        ;
        $permiso18 = Permiso::firstOrCreate([
            'nombre' => 'Editar Permiso','slug' => 'permisos.editar'
        ])
        ;
        $permiso19 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Permiso','slug' => 'permisos.eliminar'
        ])
        ;
        $permiso20 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Permiso','slug' => 'permisos.restaurar'
        ])
        ;
        //Permiso Role
        $permiso21 = Permiso::firstOrCreate([
            'nombre' => 'Vista Permiso/Role','slug' => 'permiso-role.inicio'
        ])
        ;
        $permiso22 = Permiso::firstOrCreate([
            'nombre' => 'Guardar Permiso/Role','slug' => 'permiso-role.guardar'
        ])
        ;
        //Menú
        $permiso23 = Permiso::firstOrCreate([
            'nombre' => 'Vista Menú','slug' => 'menus.inicio'
        ])
        ;
        $permiso24 = Permiso::firstOrCreate([
            'nombre' => 'Crear Menú','slug' => 'menus.crear'
        ])
        ;
        $permiso25 = Permiso::firstOrCreate([
            'nombre' => 'Editar Menú','slug' => 'menus.editar'
        ])
        ;
        $permiso26 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Menú','slug' => 'menus.eliminar'
        ])
        ;
        $permiso27 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Menú','slug' => 'menus.restaurar'
        ])
        ;
        //Menú - Role
        $permiso28 = Permiso::firstOrCreate([
            'nombre' => 'Vista Menú/Roles','slug' => 'menu-role.inicio'
        ])
        ;
        $permiso29 = Permiso::firstOrCreate([
            'nombre' => 'Guardar Menú/Roles','slug' => 'menu-role.guardar'
        ])
        ;

        //Aplicación Interés
        $permiso30 = Permiso::firstOrCreate([
            'nombre' => 'Vista Frecuencia Pago','slug' => 'frecuencia-pagos.inicio'
        ])
        ;
        $permiso31 = Permiso::firstOrCreate([
            'nombre' => 'Crear Frecuencia Pago','slug' => 'frecuencia-pagos.crear'
        ])
        ;
        $permiso32 = Permiso::firstOrCreate([
            'nombre' => 'Editar Frecuencia Pago','slug' => 'frecuencia-pagos.editar'
        ])
        ;
        $permiso33 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Frecuencia Pago','slug' => 'frecuencia-pagos.eliminar'
        ])
        ;
        $permiso34 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Frecuencia Pago','slug' => 'frecuencia-pagos.restaurar'
        ])
        ;

        //Aplicación Interés
        $permiso35 = Permiso::firstOrCreate([
            'nombre' => 'Vista Aplicación Interés','slug' => 'aplicacion-intereses.inicio'
        ])
        ;
        $permiso36 = Permiso::firstOrCreate([
            'nombre' => 'Crear Aplicación Interés','slug' => 'aplicacion-intereses.crear'
        ])
        ;
        $permiso37 = Permiso::firstOrCreate([
            'nombre' => 'Editar Aplicación Interés','slug' => 'aplicacion-intereses.editar'
        ])
        ;
        $permiso38 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Aplicación Interés','slug' => 'aplicacion-intereses.eliminar'
        ])
        ;
        $permiso39 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Aplicación Interés','slug' => 'aplicacion-intereses.restaurar'
        ])
        ;

        //Aplicación Mora
        $permiso40 = Permiso::firstOrCreate([
            'nombre' => 'Vista Aplicación Mora','slug' => 'aplicacion-moras.inicio'
        ])
        ;
        $permiso41 = Permiso::firstOrCreate([
            'nombre' => 'Crear Aplicación Mora','slug' => 'aplicacion-moras.crear'
        ])
        ;
        $permiso42 = Permiso::firstOrCreate([
            'nombre' => 'Editar Aplicación Mora','slug' => 'aplicacion-moras.editar'
        ])
        ;
        $permiso43 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Aplicación Mora','slug' => 'aplicacion-moras.eliminar'
        ])
        ;
        $permiso44 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Aplicación Mora','slug' => 'aplicacion-moras.restaurar'
        ])
        ;

        //Moneda
        $permiso45 = Permiso::firstOrCreate([
            'nombre' => 'Vista Moneda','slug' => 'monedas.inicio'
        ])
        ;
        $permiso46 = Permiso::firstOrCreate([
            'nombre' => 'Crear Moneda','slug' => 'monedas.crear'
        ])
        ;
        $permiso47 = Permiso::firstOrCreate([
            'nombre' => 'Editar Moneda','slug' => 'monedas.editar'
        ])
        ;
        $permiso48 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Moneda','slug' => 'monedas.eliminar'
        ])
        ;
        $permiso49 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Moneda','slug' => 'monedas.restaurar'
        ])
        ;

        //Empleados
        $permiso50 = Permiso::firstOrCreate([
            'nombre' => 'Vista Empleado','slug' => 'empleados.inicio'
        ])
        ;
        $permiso51 = Permiso::firstOrCreate([
            'nombre' => 'Crear Empleado','slug' => 'empleados.crear'
        ])
        ;
        $permiso52 = Permiso::firstOrCreate([
            'nombre' => 'Editar Empleado','slug' => 'empleados.editar'
        ])
        ;
        $permiso53 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Empleado','slug' => 'empleados.eliminar'
        ])
        ;
        $permiso54 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Empleado','slug' => 'empleados.restaurar'
        ])
        ;

        //Clientes
        $permiso55 = Permiso::firstOrCreate([
            'nombre' => 'Vista Cliente','slug' => 'clientes.inicio'
        ])
        ;
        $permiso56 = Permiso::firstOrCreate([
            'nombre' => 'Crear Cliente','slug' => 'clientes.crear'
        ])
        ;
        $permiso57 = Permiso::firstOrCreate([
            'nombre' => 'Editar Cliente','slug' => 'clientes.editar'
        ])
        ;
        $permiso58 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Cliente','slug' => 'clientes.eliminar'
        ])
        ;
        $permiso59 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Cliente','slug' => 'clientes.restaurar'
        ])
        ;

        //Préstamos
        $permiso60 = Permiso::firstOrCreate([
            'nombre' => 'Vista Prestamo','slug' => 'prestamos.inicio'
        ])
        ;
        $permiso61 = Permiso::firstOrCreate([
            'nombre' => 'Crear Prestamo','slug' => 'prestamos.crear'
        ])
        ;
        $permiso62 = Permiso::firstOrCreate([
            'nombre' => 'Editar Prestamo','slug' => 'prestamos.editar'
        ])
        ;
        $permiso63 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Prestamo','slug' => 'prestamos.eliminar'
        ])
        ;
        $permiso64 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Prestamo','slug' => 'prestamos.restaurar'
        ])
        ;
        $permiso65 = Permiso::firstOrCreate([
            'nombre' => 'Aceptar Prestamo','slug' => 'prestamos.aceptar'
        ])
        ;

        $permiso66 = Permiso::firstOrCreate([
            'nombre' => 'Rechazar Prestamo','slug' => 'prestamos.rechazar'
        ])
        ;

        $permiso67 = Permiso::firstOrCreate([
            'nombre' => 'Imprimir Contrato Prestamo','slug' => 'prestamos.imprimir-contrato'
        ])
        ;

        $permiso68 = Permiso::firstOrCreate([
            'nombre' => 'Ver Prestamo','slug' => 'prestamos.mostrar'
        ])
        ;

        $permiso69 = Permiso::firstOrCreate([
            'nombre' => 'Ver Cuotas Préstamo','slug' => 'prestamos.ver-cuotas'
        ])
        ;

        $permiso70 = Permiso::firstOrCreate([
            'nombre' => 'Enviar Notificaciones Préstamo','slug' => 'prestamos.enviar-notificaciones'
        ])
        ;

        $permiso71 = Permiso::firstOrCreate([
            'nombre' => 'Anular Préstamo','slug' => 'prestamos.anular'
        ])
        ;

        $permiso72 = Permiso::firstOrCreate([
            'nombre' => 'Mostar Observaciones Préstamo','slug' => 'prestamos.observaciones'
        ])
        ;

        $permiso73 = Permiso::firstOrCreate([
            'nombre' => 'Subir Contrato Préstamo','slug' => 'prestamos.subir-contrato'
        ])
        ;

        $permiso74 = Permiso::firstOrCreate([
            'nombre' => 'Ver Contrato Préstamo','slug' => 'prestamos.ver-contrato'
        ])
        ;


        //REGISTRO PAGOS
        $permiso75 = Permiso::firstOrCreate([
            'nombre' => 'Nuevo Registro Pago','slug' => 'registro-pagos.nuevo'
        ])
        ;
        $permiso76 = Permiso::firstOrCreate([
            'nombre' => 'Editar Registro Pago','slug' => 'registro-pagos.editar'
        ])
        ;

        $permiso77 = Permiso::firstOrCreate([
            'nombre' => 'Subir Voucher Registro Pago','slug' => 'registro-pagos.subir-voucher'
        ])
        ;

        $permiso78 = Permiso::firstOrCreate([
            'nombre' => 'Subir DNI Cliente','slug' => 'clientes.subir-dni'
        ])
        ;
        $permiso79 = Permiso::firstOrCreate([
            'nombre' => 'Desembolsar Préstamo','slug' => 'prestamos.desembolsar'
        ])
        ;
        $permiso80 = Permiso::firstOrCreate([
            'nombre' => 'Subir VOucher Desembolso Préstamo','slug' => 'prestamos.voucher-desembolso'
        ])
        ;

        $permiso81 = Permiso::firstOrCreate([
            'nombre' => 'Registro Pago Historial','slug' => 'registro_pagos.historial'
        ])
        ;

        $permiso82 = Permiso::firstOrCreate([
            'nombre' => 'Nueva Notificación','slug' => 'notificaciones.nuevo'
        ])
        ;

        $permiso83 = Permiso::firstOrCreate([
            'nombre' => 'Editar Notificación','slug' => 'notificaciones.editar'
        ])
        ;

        $permiso84 = Permiso::firstOrCreate([
            'nombre' => 'Mostrar Notificación','slug' => 'notificaciones.mostrar'
        ])
        ;

        $permiso85 = Permiso::firstOrCreate([
            'nombre' => 'Habilitar Notificación','slug' => 'notificaciones.habilitar'
        ])
        ;

        $permiso86 = Permiso::firstOrCreate([
            'nombre' => 'Deshabilitar Notificación','slug' => 'notificaciones.deshabilitar'
        ])
        ;

        $permiso87 = Permiso::firstOrCreate([
            'nombre' => 'Vista Notificaciones','slug' => 'notificaciones.inicio'
        ])
        ;

        $permiso88 = Permiso::firstOrCreate([
            'nombre' => 'Vista Notificaciones','slug' => 'notificaciones.eliminar'
        ])
        ;

        $permiso89 = Permiso::firstOrCreate([
            'nombre' => 'Configuraciones Empresa','slug' => 'configuraciones-empresa.inicio'
        ])
        ;

        //Inversionistas
        $permiso90 = Permiso::firstOrCreate([
            'nombre' => 'Vista Inversionista','slug' => 'inversionistas.inicio'
        ])
        ;
        $permiso91 = Permiso::firstOrCreate([
            'nombre' => 'Crear Inversionista','slug' => 'inversionistas.crear'
        ])
        ;
        $permiso92 = Permiso::firstOrCreate([
            'nombre' => 'Editar Inversionista','slug' => 'inversionistas.editar'
        ])
        ;
        $permiso93 = Permiso::firstOrCreate([
            'nombre' => 'Eliminar Inversionista','slug' => 'inversionistas.eliminar'
        ])
        ;
        $permiso94 = Permiso::firstOrCreate([
            'nombre' => 'Restaurar Inversionista','slug' => 'inversionistas.restaurar'
        ])
        ;

        //REGISTRO INVERSIONES
        $permiso95 = Permiso::firstOrCreate([
            'nombre' => 'Nuevo Registro de Inversión','slug' => 'registro-inversiones.nuevo'
        ])
        ;
        $permiso96 = Permiso::firstOrCreate([
            'nombre' => 'Editar Registro de Inversión','slug' => 'registro-inversiones.editar'
        ])
        ;
        $permiso97 = Permiso::firstOrCreate([
            'nombre' => 'Historial de Registro de Inversión','slug' => 'registro-inversiones.historial'
        ])
        ;



        $role1->permisos()->sync([
            $permiso1->id, $permiso2->id,$permiso3->id,$permiso4->id,$permiso5->id,$permiso6->id,$permiso7->id,$permiso8->id,$permiso9->id,$permiso10->id,
            $permiso11->id, $permiso12->id,$permiso13->id,$permiso14->id,$permiso15->id,$permiso16->id,$permiso17->id,$permiso18->id,$permiso19->id,$permiso20->id,
            $permiso21->id, $permiso22->id,$permiso23->id,$permiso24->id,$permiso25->id,$permiso26->id,$permiso27->id,$permiso28->id,$permiso29->id,$permiso30->id,
            $permiso31->id, $permiso32->id,$permiso33->id,$permiso34->id,$permiso35->id,$permiso36->id,$permiso37->id,$permiso38->id,$permiso39->id,$permiso40->id,
            $permiso41->id, $permiso42->id,$permiso43->id,$permiso44->id,$permiso45->id,$permiso46->id,$permiso47->id,$permiso48->id,$permiso49->id,$permiso50->id,
            $permiso51->id, $permiso52->id,$permiso53->id,$permiso54->id,$permiso55->id,$permiso56->id,$permiso57->id,$permiso58->id,$permiso59->id,$permiso60->id,
            $permiso61->id, $permiso62->id,$permiso63->id,$permiso64->id,$permiso65->id,$permiso66->id,$permiso67->id,$permiso68->id,$permiso69->id,$permiso70->id,
            $permiso71->id, $permiso72->id,$permiso73->id,$permiso74->id,$permiso75->id,$permiso76->id,$permiso77->id,$permiso78->id,$permiso79->id,$permiso80->id,
            $permiso81->id, $permiso82->id,$permiso83->id,$permiso84->id,$permiso85->id,$permiso86->id,$permiso87->id,$permiso88->id,$permiso89->id,$permiso90->id,
            $permiso91->id, $permiso92->id,$permiso93->id,$permiso94->id
        ]);

        $role2->permisos()->sync([
            $permiso1->id, $permiso2->id,$permiso3->id,$permiso4->id,$permiso5->id,$permiso6->id,$permiso7->id,$permiso8->id,$permiso9->id,$permiso10->id,
            $permiso11->id, $permiso12->id,$permiso13->id,$permiso14->id,$permiso15->id,$permiso16->id,$permiso17->id,$permiso18->id,$permiso19->id,$permiso20->id,
            $permiso21->id, $permiso22->id,$permiso23->id,$permiso24->id,$permiso25->id,$permiso26->id,$permiso27->id,$permiso28->id,$permiso29->id,$permiso30->id,
            $permiso31->id, $permiso32->id,$permiso33->id,$permiso34->id,$permiso35->id,$permiso36->id,$permiso37->id,$permiso38->id,$permiso39->id,$permiso40->id,
            $permiso41->id, $permiso42->id,$permiso43->id,$permiso44->id,$permiso45->id,$permiso46->id,$permiso47->id,$permiso48->id,$permiso49->id,$permiso50->id,
            $permiso51->id, $permiso52->id,$permiso53->id,$permiso54->id,$permiso55->id,$permiso56->id,$permiso57->id,$permiso58->id,$permiso59->id,$permiso60->id,
            $permiso61->id, $permiso62->id,$permiso63->id,$permiso64->id,$permiso65->id,$permiso66->id,$permiso67->id,$permiso68->id,$permiso69->id,$permiso70->id,
            $permiso71->id, $permiso72->id,$permiso73->id,$permiso74->id,$permiso75->id,$permiso76->id,$permiso77->id,$permiso78->id,$permiso79->id,$permiso80->id,
            $permiso81->id, $permiso82->id,$permiso83->id,$permiso84->id,$permiso85->id,$permiso86->id,$permiso87->id,$permiso88->id,$permiso89->id,$permiso90->id,
            $permiso91->id, $permiso92->id,$permiso93->id,$permiso94->id
        ]);

        $role3->permisos()->sync([
            $permiso1->id, $permiso55->id,$permiso56->id,$permiso57->id,$permiso58->id,$permiso59->id,$permiso60->id,
            $permiso61->id, $permiso62->id,$permiso67->id,$permiso68->id,$permiso69->id,$permiso70->id,
            $permiso72->id,$permiso73->id,$permiso74->id,$permiso75->id,$permiso76->id,$permiso77->id,$permiso78->id,
            $permiso81->id
        ]);

        $role4->permisos()->sync([
            $permiso1->id, $permiso55->id,$permiso56->id,$permiso57->id,$permiso58->id,$permiso59->id,$permiso60->id,
            $permiso61->id, $permiso62->id,$permiso67->id,$permiso68->id,$permiso69->id,$permiso70->id,
            $permiso72->id,$permiso73->id,$permiso74->id,$permiso75->id,$permiso76->id,$permiso77->id,$permiso78->id,
            $permiso81->id,
        ]);

        $role5->permisos()->sync([
            $permiso95->id, $permiso96->id,$permiso97->id
        ]);
    }
}
