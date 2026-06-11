<?php

namespace App\View\Components;

use App\Models\DeliveryPartner;
use Illuminate\View\Component;

class DeliveryBadge extends Component
{
    public function __construct(
        public DeliveryPartner $partner,
        public bool $showProgress = false,
    ) {}

    public function render()
    {
        return view('components.delivery-badge');
    }
}