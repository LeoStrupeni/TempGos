<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailComentarioOS extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
     protected $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
      $this->details = $details;
       $this->order = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $detvehi=explode('|',$this->order['os']->detallesVehiculo);
      return $this->subject('ProOrdersistem Mensaje Equipo De Trabajo -Orden De Servicio:'.$this->order['os']->nro_orden_interno.' -Vehiculo: '.$detvehi[1].' '.$detvehi[2].' '.$detvehi[4].' #Siniestro: '.$this->order['os']->nro_siniestro.' #reporte: '.$this->order['os']->nro_reporte)
                 ->view('Correos.mailcomentarioOS');
    }
}
