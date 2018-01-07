<?php

namespace App\Models;

use App\Framework\Model;

class Concert extends Model
{
    protected $fillables = [
        'id', 'title', 'subtitle', 'date', 'ticket_price',
        'venue', 'venue_address', 'city', 'state', 'zip',
        'additional_information'
    ];

    public function ticketPriceInDollars()
    {
        return '$'.number_format($this->ticket_price / 100, 2);
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'ticket_price' => $this->ticketPriceInDollars()
        ]);
    }
}