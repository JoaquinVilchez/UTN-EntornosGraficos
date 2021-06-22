<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function inscription()
    {
        return $this->HasMany(Inscription::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function subjects()
    {
        return $this->BelongsToMany(Subject::class)->withPivot('role')->withPivot('status');
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getType()
    {
        if ($this->type == 'student') {
            return 'Estudiante';
        } elseif ($this->type == 'teacher') {
            return 'Docente';
        } elseif ($this->type == 'admin') {
            return 'Administrador';
        }
    }

    public function getRole($subject_id)
    {

        $subject = $this->subjects->where('id', $subject_id);
        
        $role = $subject->first()->pivot->role;
        
        return $role;            
        
    }


    public function getRoleSpanish($id){
        
        if($this->getRole($id) == 'titular'){
            $rol = 'Titular';
            
        }

        elseif($this->getRole($id) == 'alternate'){
            $rol = 'Suplente';
        }

        return $rol;
    }


    public function getStatusofSubject($subject_id)
    {

        $subject = $this->subjects->where('id', $subject_id);
        
        $status = $subject->first()->pivot->status;
        
        return $status;            
        
    }


    public function getStatusofSubjectSpanish($id){
        

        $status = null;

        if($this->getStatusofSubject($id) == 'approved'){
            $status = 'Aprobado';
        }

        elseif($this->getStatusofSubject($id) == 'regular'){
            $status = 'Regular';
        }

        elseif($this->getStatusofSubject($id) == 'enrolled'){
            $status = 'Inscripto';
        }

        elseif($this->getStatusofSubject($id) == 'not_enrolled'){
            $status = 'No incripto';
        }

        return $status;
    }

   

    
    



}
