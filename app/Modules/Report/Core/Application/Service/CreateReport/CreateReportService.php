<?php

namespace App\Modules\Report\Core\Application\Service\CreateReport;


use App\Modules\Report\Infrastructure\Repository\ReportRepository;
use App\Modules\Report\Core\Domain\Model\ReportClass;

class CreateReportService
{

    public function __construct(
        private ReportRepository $report_repository
    )
    {
    }

    public function executeSave(CreateReportRequest $request){
        $report = new ReportClass(
            $request->subject,
            $request->description,
            $request->user_id,
        );

        $this->report_repository->save($report);
        return redirect('/report/create')->with('success', 'Report sent!');
    }

    public function executeDelete($id){

        $this->report_repository->delete($id);
        return redirect()->back()->with('success', 'Report deleted!');
    }
}