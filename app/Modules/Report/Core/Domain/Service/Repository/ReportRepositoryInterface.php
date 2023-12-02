<?php

namespace App\Modules\Report\Core\Domain\Service\Repository;

use App\Modules\Report\Core\Domain\Model\ReportClass;

interface ReportRepositoryInterface
{
    public function save(ReportClass $report);
    public function delete($id);
    
}

?>