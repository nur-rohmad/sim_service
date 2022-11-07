<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('report/index', [
            'data' => Service::getReport()
        ]);
    }

    // get all report
    public function getReportData()
    {
        $response = [
            "status" => "OK",
            "data" => Service::getReport()
        ];
        return $response;
    }

    // funciton untuk melakuak pencarian dimenu report
    public function filterhReport(Request $request)
    {
        // validation request

        $validator = Validator::make($request->all(), [
            'tgl_service_awal' => "required",
            'tgl_service_akhir' => "required",
        ]);
        if ($validator->fails()) {
            $response = [
                "status" => "Failed",
                "data" => $validator->errors()
            ];
            return $response;
        } else {
            // jika telah melewati validasi
            $response = [
                "status" => "OK",
                "data" => Service::getReportBy($request->tgl_service_awal, $request->tgl_service_akhir)
            ];
            return $response;
        }
    }
}
