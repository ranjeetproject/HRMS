<?php


namespace App\Repositories;

use App\User;
use App\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Mail;


class AccountInfoRepository
{

    public function getAll()
    {
        $data = Account::orderBy('created_at', 'DESC')->get([
            'id', 'email'
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="" data-toggle="tooltip"
                data-placement="top" title="View" class="btn btn-info">
                <i class="fas fa-eye"></i></a>
                <a href="" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                </a>';

                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);
        }
    public function fetchUser()
    {
        return User::where('user_type', '!=', 0)->get([
            'id', 'name','email'
        ]);
    }

    public function insert($inputData)
    {
        $inputData['join_date'] = date('Y-m-d',strtotime($inputData['join_date']));
        $data['email'] = $inputData['email'];
        $data['net_pay'] = $inputData['net_pay'];
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('pdf.invoice',$data);
        $filename = 'Invoice_Details';
        $path=public_path('invoicePdf');
        $pdf->save($path.'/'.$filename.'.pdf');
        $fullPath=asset('invoicePdf/'.$filename.'.pdf');
        $row = Account::create($inputData);
       
        if ($row && $row->id > 0) {
            Mail::send('emails.InvoiceMail', ['user' => $row], function ($m) use ($row,$fullPath) {
                $m->from(Config::get('app.email_send'),'HRMS');
                $m->to($row->email)->subject('Pay Slip');
                $m->attach($fullPath);
            });
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }
}