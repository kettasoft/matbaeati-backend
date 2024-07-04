<?php

namespace Modules\Advertisements\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Advertisements\Entities\Advertisement;

class AdvertisementCreated
{
    use SerializesModels;

    public Advertisement $advertisement;

    /**
     * Create a new event instance.
     */
    public function __construct(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;
    }
}
