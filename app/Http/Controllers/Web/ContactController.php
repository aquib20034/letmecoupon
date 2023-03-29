<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Subscriber;
use App\Contact;
use App\WebModel\Site;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\WebModel\Page;

class ContactController extends Controller
{

    public function submitSubscribe( Request $request ) {
        $data = $request->all();
        $model = new Subscriber;
        $checkSubscriber = $model->where('email', $data['data']['email'])->first();
        if($checkSubscriber){
      	    return response()->json([
  	            'success'    => true,
  	            'msg'        => '<div class="finalCartPopup" style="display : block;">
                                        <div class="msg" style="display : block;font-size: 14px;line-height: 20px;margin-top: 10px;margin-bottom: -7px;">'.
                                        trans('sentence.already_sub').'
                                        </div>
                                    </div>'
  	        ]);
        }

        $details = ip_details(get_client_ip());
        if($details['ip'] == '::1' || !isset($details['loc'])){
            $model->email = $data['data']['email'];
            $model->page_link = url()->current();
            $model->longitude = '12.4343434343';
            $model->latitude = '98.8988776655';
            $model->country = "Pakistan";
            $model->region = "Sindh";
            $model->city = "Karachi";
            $model->ip = $details['ip'];
            $model->client_agent = $details['ip'];
            $model->site_id = config('app.siteid');
            $model->save();
            return response()->json([
                'success'   => true,
                'msg'       => '<div class="" style="display : block;">
                                        <div class="msg errorMsg finalCartPopup_errorMsg" style="display : block;font-size: 14px;line-height: 20px;margin-top: 10px;margin-bottom: -7px;">'.
                                        trans('sentence.success_sub').'
                                        </div>
                                    </div>'
            ]);
        }
        else{
            $model->email = $data['data']['email'];
            $model->page_link = url()->current();
            $loc = explode(',', $details['loc']);
            $model->longitude = $loc[0];
            $model->latitude = $loc[1];
            $model->country = $details['country'];
            $model->region = $details['region'];
            $model->city = $details['city'];
            $model->ip = get_client_ip();
            $model->client_agent = $request->server('HTTP_USER_AGENT');
            $model->site_id = config('app.siteid');
            $model->save();
            return response()->json([
                'success'   => true,
                'msg'       => '<div class="" style="display : block;">
                                        <div class="msg errorMsg finalCartPopup_errorMsg" style="display : block;font-size: 14px;line-height: 20px;margin-top: 10px;margin-bottom: -7px;">'.
                                        trans('sentence.success_sub').'
                                        </div>
                                    </div>'
            ]);
        }
    }

    public function contactDetails(){
        $data['pageCss'] = 'contact';
        $siteid = config('app.siteid');
        $page = Page::where('title','contact-us')->CustomWhereBasedDataForMetaInfo($siteid)->first();
        if(isset($page)){
            $meta['title']      =   $page->meta_title ?? '';
            $meta['description']=   $page->meta_description ?? '';
            $data['meta']       =   $meta;    
        }           
        return view('web.contact.index')->with($data);
    }

    public function contactStore(Request $request){
        $data = $request->except(['_token']);
        $model = new Contact;
        $checkContactUser = $model->where('email', $data['data']['email'])->first();
        if($checkContactUser){
            return response()->json([
                'success' => true,
                'msg' => '<div class="finalCartPopup" style="display : block;">
                <div class="msg errorMsg finalCartPopup_errorMsg" style="display : block;font-size: 14px;line-height: 20px;margin-top: 10px;margin-bottom: -7px;">'.trans('sentence.contact_success').'</div>
                </div>'
            ]);
        }
        $model->name = $data['data']['name'];
        $model->email = $data['data']['email'];
        $model->contact = $data['data']['contact'];
        // $model->subject = $data['data']['subject'];
        $model->subject = "";
        $model->message = $data['data']['message'];
        $model->save();
        return response()->json([
            'success' => true,
            'msg' => '<div class="finalCartPopup" style="display : block;">
            <div class="msg errorMsg finalCartPopup_errorMsg" style="display : block;font-size: 14px;line-height: 20px;margin-top: 10px;margin-bottom: -7px;">'.trans('sentence.contact_success').'</div>
            </div>'
        ]);
    }
}
