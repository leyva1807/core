<?php

namespace App\Models;

use App\Models\Cuenta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo TitularTarjeta
 * Representa a los titulares de tarjetas en la base de datos.
 */
class TitularTarjeta extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo.
     */
    protected $table = 'titular_tarjetas';

    /**
     * Atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'direccion',
    ];

    /**
     * Atributos ocultos en las respuestas JSON.
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Atributos que deben ser convertidos a tipos nativos.
     */
    protected $casts = [
        'correo' => 'string',
        'telefono' => 'string',
    ];

    /**
     * Relación: Un titular tiene muchas cuentas.
     */
    public function cuentas()
    {
        return $this->hasMany(Cuenta::class, 'propietario_id');
    }

    /**
     * Mutador: Capitaliza el nombre al guardarlo.
     */
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = ucwords(strtolower($value));
    }

    /**
     * Accesor: Formatea el teléfono con el código de Perú.
     */
    protected function telefono(): Attribute
    {
        return Attribute::make(
            get: fn($value) => "+51 $value"
        );
    }

    /**
     * Query Scope: Filtra titulares por nombre.
     */
    public function scopeBuscarPorNombre($query, $nombre)
    {
        return $query->where('nombre', 'LIKE', "%$nombre%");
    }

    /**
     * Verifica si un correo ya existe.
     */
    public static function correoExiste($correo)
    {
        return self::where('correo', $correo)->exists();
    }
}