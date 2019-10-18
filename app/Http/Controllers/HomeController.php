<?php

namespace App\Http\Controllers;


use App\Exports\StatsExport;
use App\Lib\StatGenerator;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Excel;

class HomeController extends Controller
{
    

    public $statse;
    public $choosenModel;
    public $dateFormat;
    public $requestModel;
    public $test;
    public $export;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('admin');
    }

    public function dataExportXLSX(){
        $stats = $this->formData();
        $today = date("Ymd");  
        
        return (new StatsExport($stats))->download($this->requestModel.'_'.'prospects_'.$today.'.xlsx');

    }

    public function dataExportCSV(){
        $stats = $this->formData();
        $today = date("Ymd");  
        return (new StatsExport($stats))->download($this->requestModel.'_'.'prospects_'.$today.'.csv', Excel::CSV, ['Content-Type' => 'text/csv']);
    }

    public function formData()
    {
        $today = date("Ymd");  
        $modelUdp = 'App\ModelsUdp\Prospect';
        $modelAstuceCredit ='App\ModelsAstuceCredit\Prospect';
        $this->choosenModel = null;
        $this->requestModel = request('requestmodel','udp');

        switch ($this->requestModel) {
            case 'udp':
                $this->choosenModel = $modelUdp;
            break;
            case 'astuce':
                $this->choosenModel = $modelAstuceCredit;
            break;
            default:
                $this->choosenModel = $modelUdp;
            break;
        }


        $firstDate = $this->choosenModel::orderBy('created_at', 'asc')->withTrashed()->limit(1)->first()->created_at;
        $lastDate = Carbon::now();
        $wantedData=[
            'state'=>[
                'type'=>'relation',
                'field'=>'name',
                'data'=>[
                    'not processed',
                    'in progress',
                    'accepted',
                    'rejected',
                    'signed',
                    'dropped'
                    
                ]
                
            ],
            'completion'=>[
                'type'=>'relation',
                'field'=>'name',
                'data'=>[
                    'incomplete',
                    'complete'
                ]
                
            ],

            'loan'=>[
                'type'=>'relation',
                'field'=>'name',
                'data'=>[
                    'Prêt à tempérament',
                    'Regroupement de crédit',
                    'Prêt voiture neuve'
                ]
                
            ],

        ];

        $this->dateFormat = request('dateFormat', 'Y-m');
        $statGenerator = new StatGenerator($firstDate,$lastDate,$wantedData,$this->dateFormat,$this->choosenModel);
        $statGenerator->handle();
        return $statGenerator->getStats();
        
    }

    public function dataView(){
        $stats = $this->formData();
        
        $this->statse = $stats->paginate(10);
        $statsView = ($this->statse)->appends([
            'dateFormat' => $this->dateFormat,
            'requestmodel' => $this->requestModel
        ]);
        
        return view('home',compact('statsView'));

    }

    public function formResult(){
         $statsView = $this->statse;

         return view('home',compact('statsView'));
    }

}
