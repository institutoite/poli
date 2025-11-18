<?php

namespace Database\Seeders;

use App\Models\Aeronave;
use App\Models\Fabricante;
use App\Models\Hangar;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AeronavesSeeder extends Seeder
{
    public function run(): void
    {
        // Helpers de normalización
        $ensureFabricante = function (string $texto): int {
            $t = strtolower($texto);
            if (str_contains($t, 'robinson')) $name = 'Robinson';
            elseif (str_contains($t, 'beech')) $name = 'Beechcraft';
            elseif (str_contains($t, 'cessna')) $name = 'Cessna';
            elseif (str_contains($t, 'embraer')) $name = 'Embraer';
            elseif (str_contains($t, 'airbus')) $name = 'Airbus';
            elseif (str_contains($t, 'pipp') || str_contains($t, 'piper')) $name = 'Piper';
            else $name = ucfirst($texto);

            return Fabricante::firstOrCreate(['nombre' => $name], [ 'pais' => null ])->id;
        };

        $ensureHangar = function (string $nombre, ?string $codigo = null, ?string $ubicacion = null): int {
            return Hangar::firstOrCreate(['nombre' => trim($nombre)], [ 'codigo' => $codigo, 'ubicacion' => $ubicacion ])->id;
        };

        // Asegurar hangares más usados
        $hangar5051Id = $ensureHangar('HANGAR 50-51', 'H-50-51', 'Base');
        $hangar106Id  = $ensureHangar('HANGAR 106', 'H-106', 'Base');
        $trinidadId   = $ensureHangar('TRINIDAD', 'TRI', 'Trinidad');

        // PB-001 ya existe por seed anterior: actualizar/crear de forma idempotente
        Aeronave::updateOrCreate(
            ['matricula' => 'PB-001'],
            [
                'tipo' => 'ala rotatoria',
                'modelo' => 'Raven R44',
                'marca' => 'robinson',
                'numero_serie' => 'S/N',
                'numero_parte' => 'S/N',
                'fabricante_id' => $ensureFabricante('ROBINSON HELICOPTER COMPANY'),
                'estado' => 'mantenimiento',
                'hangar_id' => $hangar5051Id,
                'ubicacion_actual' => 'HANGAR 50-51',
                'documento_legal' => 'PROPIEDAD DE MINISTERIO DE GOBIERNO',
            ]
        );

        // Registros 2..20
        $rows = [
            ['PB-002','ala rotatoria','Rave R44','robinson','S/N','S/N','ROBINSON HELICOPTER COMPANY','mantenimiento',$hangar5051Id,'PROPIEDAD DE MINISTERIO DE GOBIERNO'],
            ['PB-003','ala fija','Beechcraft Baron B58','beechcraft','TH-1202','S/N','BEECHCRAFT CORPORATION','inactivo',$hangar106Id,'ACTA NOTARIAL N°58/2022 ENTREGA Y RECEPCION DE AERONAVE'],
            ['PB-004','ala fija','Cessna TU206G','cessna','S/N','S/N','CESSNA COMPANY','activo',$hangar106Id,'CON ENTREGA DE BIENES DE LA DIRECCION GENERAL DE REGISTRO, CONTROL Y ADMINISTRACIÓN DE BIENES INCAUTADOS OFICINA NACIONAL'],
            ['PB-005','ala fija','Cessna T210L','cessna','21061217','S/N','CESSNA COMPANY','inactivo',$hangar106Id,'ACTA DE ENTREGA PROVISIONAL'],
            ['PB-009','ala rotatoria','Modelo 10-540-AIA5','robinson','SN11246','S/N','ROBINSON HELICOPTER COMPANY','activo',$hangar106Id,'ENTREGA DE BIENES DE LA DIRECCION GENERAL DE REGISTRO, CONTROL Y ADMINISTRACIÓN DE BIENES INCAUTADOS OFICINA NACIONAL'],
            ['PB-013','ala fija','Cessna 210','cessna','S/N','S/N','CESSNA COMPANY','activo',$hangar106Id,'ENTREGA  BIENES DE LA DIRECCION GENERAL DE REGISTRO, CONTROL Y ADMINISTRACIÓN DE BIENES INCAUTADOS OFICINA NACIONAL'],
            ['PB-008','ala fija','EMB-810D Seneca III','embraer','810777','S/N','EMBRAER','inactivo',$hangar106Id,'ENTREGA DE BIENES DE LA DIRECCION GENERAL DE REGISTRO, CONTROL Y ADMINISTRACIÓN DE BIENES INCAUTADOS OFICINA NACIONAL'],
            ['PB-010','ala rotatoria','AS350B2','airbus','3454','S/N','AIRBUS COMPANY','inactivo',$hangar106Id,'ENTREGA DE UN HELICOPTERO EN CALIDAD DE DEPOSITARIO'],
            ['PT-ODU','ala fija','Baron B58','beechcraft','TH-1259','S/N','BEECHCRAFT CORPORATION','inactivo',$hangar106Id,'ENTREGA DE BIENES DE LA DIRECCION GENERAL DE REGISTRO, CONTROL Y ADMINISTRACIÓN DE BIENES INCAUTADOS OFICINA NACIONAL'],
            ['PS-ARL','ala fija','Baron B55','beechcraft','TE-1140','S/N','BEECHCRAFT CORPORATION','inactivo',$hangar106Id,'ACTA DE ENTREGA DE LA FELCN A DIRCABI'],
            ['CP-2899','ala fija','Cessna 206','cessna','S/N','S/N','CESSNA COMPANY','inactivo',$hangar106Id,'ACTA DE ENTREGA DE LA FELCN A DIRCABI'],
            ['PT-','ala fija','Cessna 206','cessna','U2061317','S/N','CESSNA COMPANY','inactivo',$hangar106Id,'ACTA DE ENTREGA DE LA FELCN A DIRCABI'],
            ['CP-2293','ala fija','Cessna 188','cessna','S/N','S/N','CESSNA COMPANY','inactivo',$hangar106Id,'CON REQUERIMIENTO FISCA DE CUSTODIA'],
            ['CP-2543','ala fija','Cessna 207','cessna','20700593','S/N','CESSNA COMPANY','inactivo',$hangar5051Id,'CON ACTA DE DEPOSITARIO PROVISIONAL EN LA DDSAPSC'],
            ['CP-2915','ala fija','Cessna 206','cessna','U2060469','S/N','CESSNA COMPANY','inactivo',$hangar5051Id,'CON INVENTARIO  DE DIRCABI'],
            ['PP-PMC','ala fija','Cessna 206','cessna','S/N','S/N','CESSNA COMPANY','inactivo',$hangar5051Id,'CON INVENTARIO  DE DIRCABI'],
            ['CP-1299','ala fija','Cessna 182','cessna','S/N','S/N','CESSNA COMPANY','inactivo',$hangar5051Id,'CON ACTA DE ENTREGA CON REQUERIMIENTO FISCAL'],
            ['S/M','ala fija','Monomotor Piper','piper','S/N','S/N','PIPPER','inactivo',$trinidadId,'CON ACTA DE DEPOSITARIO PROVISIONAL'],
            ['CP-2571','ala fija','Cessna 207','cessna','S/N','S/N','CESSNA COMPANY','inactivo',$hangar106Id,'SIN ACTA DE ENTREGA EN ETAPA DE INVESTIGACION'],
        ];

        foreach ($rows as [$matricula,$tipo,$modelo,$marca,$serie,$parte,$fabricanteTxt,$estado,$hangarId,$doc]) {
            Aeronave::updateOrCreate(
                ['matricula' => $matricula],
                [
                    'tipo' => $tipo,
                    'modelo' => $modelo,
                    'marca' => $marca,
                    'numero_serie' => $serie,
                    'numero_parte' => $parte,
                    'fabricante_id' => $ensureFabricante($fabricanteTxt),
                    'estado' => $estado,
                    'hangar_id' => $hangarId,
                    'ubicacion_actual' => is_int($hangarId) ? null : $fabricanteTxt,
                    'documento_legal' => $doc,
                ]
            );
        }

        // Obtener el usuario con id = 1
        $usuario = User::find(1);
        dd($usuario);

        if (!$usuario) {
            // Si no existe el usuario con id = 1, crear uno nuevo
            $usuario = User::create([
                'id' => 1, // Forzar el ID a 1
                'name' => 'Seeder User',
                'email' => 'seeder@example.com',
                'password' => bcrypt('password'), // Contraseña predeterminada
            ]);
        }

        // Simular que este usuario está autenticado
        Auth::login($usuario);

        // Crear registros de aeronaves
        Aeronave::factory()->count(20)->create();

        // Cerrar sesión después de ejecutar el seeder
        Auth::logout();
    }
}
