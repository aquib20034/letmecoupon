<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Site;

class replaceMonths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'replace:months';
    //get current month in short and full form

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Replace Month with current month in multiple columns in multiple tables for each language that exists in website_details table';

    /**
     * Create a new command instance.
     *
     * @return void
     */


    private $currentMonthShort  = "";
    private $currentMonthFull  = "";
    private $shortForm = [];
    private $fullForm = [];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $this->currentMonthShort = \Carbon\Carbon::now()->format('M');
        $this->currentMonthFull = \Carbon\Carbon::now()->format('F');

        $this->shortForm = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $this->fullForm = ['January','February','March','April','May' ,'June','July','August','September','October','November','December'];        

        $modelNameSpace = "App";
        //defining an array of tables names and their columns that are going to be replaced
        $whereToReplace = [
                              '\Store'=>['id','name','meta_title','meta_keywords','meta_description'],
                              '\Blog'=>['id','title','meta_title','meta_keywords','meta_description'],
                              '\Event'=>['id','title','meta_title','meta_keywords','meta_description'],
                              '\Page'=>['id','title','meta_title','meta_keywords','meta_description']
                          ];

        //getting all the regions
        $regions = Site::select("id","country_code")->get()->toArray();

        //looping through all available region      
        foreach($regions as $region){

            //looping tables and columns name for each region
            foreach($whereToReplace as $tableName => $columns){
                $model = $modelNameSpace.$tableName;
                $siteid = $region['id'];
                $query = $model::with("sites")->whereHas('sites' , function($q) use ($siteid){
                                            $q->select('id', 'country_code');
                                            $q->where('site_id',$siteid);
                                });            
                foreach($columns as $column){
                    $query->addSelect($column);
                }
                $rows = $query->get()->toArray();
                foreach($rows as $row){
                    $updateArr=[];
                    foreach($columns as $column){
                        if($column=="id") continue;
                        $updateArr[$column] = $this->replaceMonths($row[$column],$region['country_code']);
                    }
                    if(!empty($updateArr)){
                        $model::where("id",$row['id'])->update($updateArr);
                    } 
                }
            }
        }
    }

    public function replaceMonths($str,$lang){
        if(empty($str) || !config("constants.months.".$lang)) return $str;
        foreach(config("constants.months.".$lang) as $monthKey => $month){
            if(in_array($month,$this->shortForm)){
                if(!isset(config("constants.months.".$lang)[$this->currentMonthShort])) return $str;
                $str = $this->replaceFromString($month,config("constants.months.".$lang)[$this->currentMonthShort],$str);
            }
            else{
                if(!isset(config("constants.months.".$lang)[$this->currentMonthFull])) return $str;
                $str = $this->replaceFromString($month,config("constants.months.".$lang)[$this->currentMonthFull],$str);            
            }
        }
        return $str;
    }


    public function replaceFromString($val,$valToBeReplaced,$str){
        if(empty($val) || empty($valToBeReplaced) || empty($str)) return $str; 
        $strArr = explode(" ",$str);
        $regeneratedString="";
        foreach($strArr as $key => $word){
            try{
                $strArr[$key] = (strtolower($word) == strtolower($val)) ? $valToBeReplaced : $word;
            }
            catch(\Exception $e){
                $strArr[$key] = ($word == $val) ? $valToBeReplaced : $word;                
            } 
        }
        foreach($strArr as $key => $word){
            if(count($strArr) != $key+1){
                $regeneratedString .= $word." ";                
            }
            else{
                $regeneratedString .= $word;
            }
        }
        return $regeneratedString;
    }

}
