<?php

namespace App\Lib;

use App\ModelsUdp\Completion;
use App\ModelsUdp\Prospect as ProspectUdp;
use App\ModelsAstuceCredit\Prospect as ProspectAstuceCredit;
use App\ModelsUdp\State;
use Illuminate\Support\Carbon;

class StatGenerator{
    public $stats;
    public $firstDate;
    public $lastDate;
    public $wantedData;
    public $dateFormat;
    public $choosenModel;
    function __construct($firstDate,$lastDate,$wantedData,$dateFormat,$choosenModel)
    {
        $this->stats = collect();
        $this->firstDate = $firstDate;
        $this->lastDate = $lastDate;
        $this->wantedData = $wantedData;
        $this->dateFormat = $dateFormat;
        $this->choosenModel = $choosenModel;
        
        
    }

    public function handle(){

        $dateRange = [$this->firstDate->startOfDay()->format('Y-m-d H:i:s'),$this->lastDate->endOfDay()->format('Y-m-d H:i:s')];

        $this->initStats();
        $this->choosenModel::withTrashed()
        ->whereBetween('created_at', $dateRange)
        ->with($this->getRelation())->chunk(5000,function ($prospects){
            $this->setData($prospects);
        });
    }

    public function getStats(){
        return $this->stats;
    }

    public function initStats(){
        
        $period =  $this->getPeriod(); // takes all the dates between firstDate to lastDate (Month)
        foreach ($period as $key => $date) { // For each date (unique by month + year) put the formated date as a key in a collection
            $date = $date->format($this->dateFormat);
            $this->stats->put($date,collect());
            foreach ($this->wantedData as $wantedDataKey => $wantedDataValue) { // 
                $this->stats[$date]->put($wantedDataKey,collect());
                foreach ($wantedDataValue['data'] as $wantedDataFinal) {
                    $this->stats[$date][$wantedDataKey]->put($wantedDataFinal,0);
                }
            }

        }
    }

    public function getRelation(){
        return collect($this->wantedData)->filter(function($row){
            return $row['type'] =='relation';
        })->keys()->toArray();
    }

    public function groupProspectByDateFormat($prospects){
        return $prospects->groupBy(function($item){
            return $item->created_at->format($this->dateFormat);
        });
    }

    public function countRelationData($value,$relation,$wantedDataKey,$field){
        return $value->filter(function ($prospect) use ($relation,$wantedDataKey,$field){
            return $prospect[$relation][$field] == $wantedDataKey;
        })->count();
    }

    public function countDirectData($value,$relation,$wantedDataKey){
        return $value->filter(function ($prospect) use ($relation,$wantedDataKey){
            return $prospect[$relation]==$wantedDataKey;
        })->count();
    }

    public function countData($value,$relation,$wantedDataKey){
        $type = $this->wantedData[$relation]['type'];
                        
        if($type=='relation'){
            $field = $this->wantedData[$relation]['field'];
            $cpt = $this->countRelationData($value,$relation,$wantedDataKey,$field);
        }else{
        
            $cpt = $this->countDirectData($value,$relation,$wantedDataKey);
        }

        return $cpt;
    }

    public function setData($prospects){
        $prospectsGroupByDate = $this->groupProspectByDateFormat($prospects);

        foreach ($prospectsGroupByDate as $date => $value) {
            foreach ($this->stats[$date] as $relation => $wantedDatas) {
                foreach ($wantedDatas as $wantedDataKey => $wantedDataValue) {
                    $this->stats[$date][$relation][$wantedDataKey] += $this->countData($value,$relation,$wantedDataKey);
                }
                
            }

        }
    }

    public function getPeriod(){
        switch ($this->dateFormat) {
            case 'Y-m-d':
                $period = $this->firstDate->startOfDay()->dayUntil($this->lastDate->startOfDay());
                break;
            case 'Y':
                $period = $this->firstDate->startOfYear()->yearUntil($this->lastDate->startOfYear());
                break;
            default:
                $period = $this->firstDate->startOfMonth()->monthUntil($this->lastDate->startOfMonth());
        }
        return $period;
    }


}