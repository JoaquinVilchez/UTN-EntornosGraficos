<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        // TODO: Tener en cuenta que si se quiere consultar que usuarios le pertenecen a una materia, solo buscará en la tabla de estudiantes y no de profesores. 
        // Habria que ver, en caso de ser necesario, como diferenciar y buscar. O plantear una unica tabla usuarios_materias que diferencie con un tipo de usuario.
        return $this->belongsToMany(User::class, 'student_subject', 'student_id', 'subject_id');
    }
}
