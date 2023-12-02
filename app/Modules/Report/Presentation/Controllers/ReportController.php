<?php

namespace App\Modules\Report\Presentation\Controllers;

use App\Modules\Report\Core\Application\Service\CreateReport\CreateReportRequest;
use App\Modules\Report\Core\Domain\Model\Report;
use App\Http\Controllers\Controller;
use App\Modules\Report\Core\Application\Service\CreateReport\CreateReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    
    public function __construct(
        private CreateReportService $create_report_service
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::all();
        return view('Report::report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Report::report.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $request = new CreateReportRequest(
            $request->subject,
            $request->description,
            Auth::user()->id
        );

        return $this->create_report_service->executeSave($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->create_report_service->executeDelete($id);
    }
}
