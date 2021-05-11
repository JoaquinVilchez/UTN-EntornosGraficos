<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $subjects = [
            ['Algebra y Geometría Analítica', 1],
            ['Algoritmos y Estructuras de Datos', 1],
            ['Análisis Matemático I', 1],
            ['Arquitectura de Computadoras', 1],
            ['Física I', 1],
            ['Ingeniería y Sociedad', 1],
            ['Matemática Discreta', 1],
            ['Sistemas y Organizaciones', 1],
            ['Análisis de Sistemas', 2],
            ['Análisis Matemático', 2],
            ['Física II', 2],
            ['Inglés l', 2],
            ['Paradigmas de Programación', 2],
            ['Química', 2],
            ['Sintaxis y Semántica de los Lenguajes', 2],
            ['Sistemas de Representación', 2],
            ['Sistemas Operativos', 2],
            ['Comunicaciones', 3],
            ['Diseño de Sistemas', 3],
            ['Economía', 3],
            ['Gestión de Datos', 3],
            ['Inglés ll', 3],
            ['Matemática Superior', 3],
            ['Probabilidades y Estadísticas', 3],
            ['Administración de Recursos', 4],
            ['Ingeniería de Software', 4],
            ['Investigación Operativa', 4],
            ['Legislación', 4],
            ['Redes de Información', 4],
            ['Simulación', 4],
            ['Teoría de Control', 4],
            ['Administración Gerencial', 5],
            ['Inteligencia Artificial', 5],
            ['Proyecto', 5],
            ['Sistemas de Gestión', 5],
        ];

        for ($i = 0; $i < 35; $i++) {
            Subject::create([
                'name' => $subjects[$i][0],
                'level' => $subjects[$i][1],
                'career' => 'ISI'
            ]);
        };
    }
}
