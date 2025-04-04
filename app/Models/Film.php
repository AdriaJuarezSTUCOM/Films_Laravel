<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    // Especifica la tabla si el nombre no sigue el estándar "films"
    protected $table = 'films';

    // Si la tabla no tiene `created_at` y `updated_at`, desactiva timestamps
    public $timestamps = true; // O false si no usas timestamps

    // Lista de atributos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'year',
        'genre',
        'country',
        'duration',
        'img_url'
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

}
