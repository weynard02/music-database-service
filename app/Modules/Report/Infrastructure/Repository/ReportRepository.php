<?php

namespace App\Modules\Report\Infrastructure\Repository;

use App\Modules\Report\Core\Domain\Model\ReportClass;
use App\Modules\Report\Core\Domain\Service\Repository\ReportRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ReportRepository implements ReportRepositoryInterface
{
    public function save(ReportClass $report) {
        DB::table('reports')->upsert([
            'subject' => $report->subject,
            'description' => $report->description,
            'user_id' => $report->user_id
        ], 'subject');
    }

    public function delete($id) {
        DB::table('reports')->where('id', $id)->delete();
    }
}