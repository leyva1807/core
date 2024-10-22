<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Modelo Cuenta
 *
 * Representa las cuentas bancarias asociadas a los titulares de tarjetas.
 */
class Cuenta extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo.
     */
    protected $table = 'cuentas';

    /**
     * Los atributos asignables en masa.
     */
    protected $fillable = [
        'titular_id',
        'tipo_moneda',
        'numero_cuenta',
        'numero_tarjeta',
        'tipo_cuenta',
        'saldo_empresa',
        'saldo_personal',
        'estado',
        'banco_asociado',
    ];

    /**
     * Los atributos que se convierten automáticamente a tipos nativos.
     */
    protected $casts = [
        'saldo_empresa' => 'float',
        'saldo_personal' => 'float',
        'estado' => 'boolean',
    ];

    /**
     * Relación: Cada cuenta pertenece a un titular de tarjeta.
     */
    public function titular()
    {
        return $this->belongsTo(TitularTarjeta::class, 'titular_id');
    }

    /**
     * Mutador para almacenar el número de cuenta en mayúsculas.
     */
    public function setNumeroCuentaAttribute($value)
    {
        $this->attributes['numero_cuenta'] = strtoupper($value);
    }

    /**
     * Accesor para mostrar el estado de la cuenta en texto.
     */
    protected function estado(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'Activa' : 'Inactiva'
        );
    }

    /**
     * Query Scope: Filtra cuentas por tipo de moneda.
     */
    public function scopeMoneda($query, $moneda)
    {
        return $query->where('tipo_moneda', $moneda);
    }

    /**
     * Función personalizada: Verifica si la cuenta está activa.
     */
    public function esActiva(): bool
    {
        return $this->estado;
    }
}