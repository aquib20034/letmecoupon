<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\AffiliateLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AffiliateLogController extends Controller
{
 

    public function index(Request $request)
    {
        abort_if(Gate::denies('affiliate_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AffiliateLog::with(["store",'coupon'])->select(sprintf('%s.*', (new AffiliateLog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'affiliate_log_access';
                $editGate      = '';
                $deleteGate    = '';
                $crudRoutePart = 'affiliate-logs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('store_name', function ($row) {
                return $row->store ? $row->store->name : '';
            });
            $table->editColumn('coupon_name', function ($row) {
                return $row->coupon ? $row->coupon->title : '';
            });
            $table->editColumn('previous_aff_url', function ($row) {
                return $row->previous_aff_url ? $row->previous_aff_url : "";
            });
            $table->editColumn('new_aff_url', function ($row) {
                return $row->new_aff_url ? $row->new_aff_url : "";
            });   
            $table->editColumn('action', function ($row) {
                return $row->action ? $row->action : "";
            });                                                   

            $table->rawColumns(['actions', 'placeholder' , 'previous_aff_url','new_aff_url','action']);

            return $table->make(true);
        }

        return view('admin.affiliateLog.index');
    }


    public function show(AffiliateLog $affiliateLog)
    {
        abort_if(Gate::denies('affiliate_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.affiliateLog.show', compact('affiliateLog'));
    }

    public function showEncrypt($par)
    {
        abort_if(Gate::denies('affiliate_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
          
            $affiliateLog = AffiliateLog::where("id",\Crypt::decrypt($par))->first();
            if(!$affiliateLog){
                abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
            }
            return view('admin.affiliateLog.show', compact('affiliateLog'));
        }
        catch(\Exception $e){
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
    }    

 

}
