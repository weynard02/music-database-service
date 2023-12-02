<?php

namespace App\Modules\Report\Core\Application\Service\CreateReport;

class CreateReportRequest
{
    public function __construct(
        public string $subject,
        public string $description,
        public int $user_id,
    )
    {
    }
}