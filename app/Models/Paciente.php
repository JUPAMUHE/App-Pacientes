<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_documento_id', 'numero_documento', 'nombre1', 'nombre2', 
        'apellido1', 'apellido2', 'genero_id', 'departamento_id', 'municipio_id', 'foto'
    ];

    public function tiposDocumento() {
        return $this->belongsTo(TiposDocumento::class);
    }

    public function genero() {
        return $this->belongsTo(Genero::class);
    }

    public function departamento() {
        return $this->belongsTo(Departamento::class);
    }
 
    public function municipio() {
        return $this->belongsTo(Municipio::class);
    }
}
