<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'tasa',
        'dias_inversion',
        'monto',
        'monto_recibir',
        'fecha_inversion',
        'fecha_pago',
        'imagen_recibo',
        'user_id',
        'estado',
        'observacion'
    ];

    protected $appends = ['dias_pago', 'dias_transcurridos', 'total_utilidad', 'porcentaje_progreso'];

    public function getDiasPagoAttribute() {
        if ($this->estado != 'aprobada') {
            return $this->dias_inversion; 
        }

        $fecha_pago = Carbon::parse($this->fecha_pago);
        $hoy = Carbon::now();
        if ($fecha_pago <= $hoy) {
            return 0;
        }
        return $hoy->diffInDays($fecha_pago);
    }

    public function getDiasTranscurridosAttribute() {
        if ($this->estado != 'aprobada') {
            return $this->dias_inversion; 
        }

        $fecha_inversion = Carbon::parse($this->fecha_inversion);
        $fecha_pago = Carbon::parse($this->fecha_pago);
        $hoy = Carbon::now();
        
        if ($hoy >= $fecha_pago) {
            return $this->dias_inversion;
        }
        
        return $fecha_inversion->diffInDays($hoy);
    }

    public function getTotalUtilidadAttribute() {
        if ($this->estado != 'aprobada') {
            return 0; 
        }

        $utilidadDiaria = round($this->monto_recibir / $this->dias_inversion, 4);
        return round($utilidadDiaria * $this->dias_transcurridos,2);
    }

    public function getPorcentajeProgresoAttribute() {
        if ($this->estado != 'aprobada') {
            return 0; 
        }
        return round($this->dias_transcurridos * 100 / $this->dias_inversion);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
