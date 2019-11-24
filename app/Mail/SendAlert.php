<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Tenant;

class SendAlert extends Mailable
{
    use Queueable, SerializesModels;

    protected $alert;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($alert)
    {
        $this->alert = $alert;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tenant = Tenant::where('tenantid', $this->alert->tenant_id)->first();

        return $this->subject('Alert: '.$this->alert->type)->markdown('emails.alert')
            ->with([
                'tenant' => $tenant->name,
                'tenant_id' => $this->alert->tenant_id,
                'alert_type' => $this->alert->type,
                'resource_type' => $this->alert->resource_type,
                'resource_name' => $this->alert->resource_name,
                'resource_details' => $this->alert->resource_details,
                'old_resource_details' => $this->alert->old_resource_details,
                'time' => $this->alert->updated_at,
            ]);
    }
}
