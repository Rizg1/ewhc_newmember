<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Admin\StoreExportRequest;
use App\Exports\MembersExport;

class MembersExportController extends Controller
{
    public function __invoke(StoreExportRequest $request) 
    { 
        $data = $request->validated();
        
        $from_date = Carbon::parse($data['from_date'])->format('Y-m-d'); 
        $end_date = Carbon::parse($data['end_date'])->format('Y-m-d');
        // dd($from_date, $end_date);

        return Excel::download(new MembersExport($from_date, $end_date), 'pre-employment.xlsx');   
    }
}
