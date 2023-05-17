<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\AffiliateLog;
use App\Site;
use App\Store;
use App\Coupon;
use App\User;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;
use GuzzleHttp\Client;


class SendEmailAboutAffiliateUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $affiliateLogId = 0; 
    public function __construct($affiliateLogId)
    {
        $this->affiliateLogId = $affiliateLogId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // try{
            $affiliateLog = AffiliateLog::where("id",$this->affiliateLogId)->first();
            if($affiliateLog){

                $site = Site::select("country_code")->where("id",$affiliateLog->website)->first();
                $brand = Store::select("name","created_at","updated_at")->where("id",$affiliateLog->store_id)->first();

               

                if(!$site || !$brand) return;

                $model = $affiliateLog->coupon_id ? "coupons" : 'stores';  

                $couponName = null;
                if($affiliateLog->coupon_id){
                   $couponName = Coupon::select("title")->where("id",$affiliateLog->coupon_id)->first();   
                   $couponName = isset($couponName->title) ? $couponName->title : '';
                }
               
                $emailData["heading"] = "Affiliate URL for store (".$brand->name.") ".$affiliateLog->action." in ".$model." module for website Compare By Us (".strtoupper($site->country_code).") ";

                $emailData["brand_name"] = isset($brand->name) ? $brand->name : '';
                $emailData["previous_affiliate_url"] = $affiliateLog->previous_aff_url;
                $emailData["action"] = $affiliateLog->action;
                $emailData["new_affiliate_url"] = $affiliateLog->new_aff_url;
             
                $emailData["id"] = $affiliateLog->id;
                $emailData["coupon_name"] = $couponName;
                

                Mail::to('hamza.saleem@8thloop.com')
                    // ->cc(['umair.khan@8thloop.com','mubashir.akhtar@8thloop.com'])
                    ->send(new \App\Mail\AffiliateUrlInfo($emailData));    

                $client = new \Google_Client();

                $client->setApplicationName('Google Sheets and PHP');
                $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
                $client->setAccessType('offline');
                $path = storage_path() . '/212343252160324234236-723429d334k823l34fjk34239sxdsdkrjcr7oc5ik989ntpi303knkfdk6b5lk.json';
           
                $client->setAuthConfig($path);
                $cellStartPoint = "Compare By Us!A2";
                $cellEndingPoint = "X" . (10);
                $cellUpdateRange = "$cellStartPoint:$cellEndingPoint";
                $service = new Google_Service_Sheets($client);
                $spreadsheetId = "1hf5MRauKzv52YR3oC5550ACc38OA50lJA3ZDsEOHyzA"; 

                $source=$affiliateLog->source;
                if(!$source){
                    $user = User::where("id",$affiliateLog->created_by)->first();
                    if($user){ $source = $user->name; }
                    else { $souce = ""; }
                }

                $couponName = "";
                if($affiliateLog->coupon_id){
                    $coupon = Coupon::select("title","created_at","updated_at")->where("id",$affiliateLog->coupon_id)->first();
                    $couponName = $coupon->title;

                }

                $newAffUrl = $affiliateLog->new_aff_url ? $affiliateLog->new_aff_url : '';
                $previousAffUrl = $affiliateLog->previous_aff_url ? $affiliateLog->previous_aff_url : '';

                if($affiliateLog->coupon_id){
                    if(strtolower($affiliateLog->action)=="created"){
                        $date = \Carbon\Carbon::parse($coupon->created_at);
                    }
                    else{
                        $date = \Carbon\Carbon::parse($coupon->updated_at);
                    }
                }
                else{
                    if(strtolower($affiliateLog->action)=="created"){
                        $date = \Carbon\Carbon::parse($brand->created_at);
                    }
                    else{
                        $date = \Carbon\Carbon::parse($brand->updated_at);
                    }                    
                }
                $date = $date->setTimezone('Asia/karachi')->format("d-m-Y H:i:s");
                $spreadSheetData=[
                    [
                        getNetworkName($affiliateLog->new_aff_url),$brand->name,$model,$couponName,strtoupper($site->country_code),$affiliateLog->action, getNetworkName($previousAffUrl) , getNetworkName($newAffUrl) , $previousAffUrl , $newAffUrl , $date
                       , $source
                    ],

                ];
                $body = new Google_Service_Sheets_ValueRange([
                    'values' => $spreadSheetData
                ]);
                $params = [
                    'valueInputOption' => 'RAW'
                ];
                
                $updateSheet = $service->spreadsheets_values->append($spreadsheetId, $cellUpdateRange, $body, $params); 

            } 
        // }
        // catch(\Exception $e){
        //     dd($e->getMessage());
        //      \Log::info("affiliate url update log => ". $e->getMessage() );
        // }    
     
    }



}
