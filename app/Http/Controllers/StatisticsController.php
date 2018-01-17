<?php
namespace App\Http\Controllers;
use App\Role;
use App\Unit;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class StatisticsController extends Controller
{
    public function getUnitsStatistics(){
        $applications = Application::all();
        $applicants_type = 'Student';
        $statistics;
        $facluty_results;
        $types_results;
        $sum_of_types;
        //TODO : check if the owner of application is: student, investigator or profesor
        foreach($applications as $application){
            if($application->event_type_id != null){
                if(isset($statistics[$application->unit->name][$application->eventType->name][$applicants_type]))
                    $statistics[$application->unit->name][$application->eventType->name][$applicants_type] += 1;
                else 
                    $statistics[$application->unit->name][$application->eventType->name][$applicants_type] = 1;
            
                if(isset($facluty_results[$application->eventType->name][$applicants_type]))
                    $types_results[$application->eventType->name][$applicants_type] += 1;
                else 
                    $types_results[$application->eventType->name][$applicants_type] = 1;

            }elseif($application->presentation_type_id !=null ){
                if(isset($statistics[$application->unit->name][$application->presentationType->name][$applicants_type]))
                    $statistics[$application->unit->name][$application->presentationType->name][$applicants_type] += 1;
                else 
                    $statistics[$application->unit->name][$application->presentationType->name][$applicants_type] = 1;
            
                if(isset($facluty_results[$application->presentationType->name][$applicants_type]))
                    $types_results[$application->presentationType->name][$applicants_type] += 1;
                else 
                    $types_results[$application->presentationType->name][$applicants_type] = 1;
                
            }
            //TODO :check if he is student and add if 
            if(isset($facluty_results[$application->unit->name][$applicants_type]))
                $facluty_results[$application->unit->name][$applicants_type] += 1;
            else 
                $facluty_results[$application->unit->name][$applicants_type] = 1; 
            
            
            if(isset($sum_of_types[$applicants_type]))
                $sum_of_types[$applicants_type] += 1;
            else 
                $sum_of_types[$applicants_type] = 1; 
        }
        
        
        
        return view('statistics.units', ['statistics'=> $statistics, 'facluty_results'=>$facluty_results, 'types_results'=>$types_results, 'sum_of_types'=>$sum_of_types]);
    }
    
    public function getTypesStatistics(){
        $applications = Application::all();
        $applicants_type = 'Student';
        $types_results;
        $sum_of_types;
        //TODO : check if the owner of application is: student, investigator or profesor
        foreach($applications as $application){
            if($application->event_type_id != null){
                if(isset($facluty_results[$application->eventType->name][$applicants_type]))
                    $types_results[$application->eventType->name][$applicants_type] += 1;
                else 
                    $types_results[$application->eventType->name][$applicants_type] = 1;
            }elseif($application->presentation_type_id !=null ){
                if(isset($facluty_results[$application->presentationType->name][$applicants_type]))
                    $types_results[$application->presentationType->name][$applicants_type] += 1;
                else 
                    $types_results[$application->presentationType->name][$applicants_type] = 1;
            }
         
            if(isset($sum_of_types[$applicants_type]))
                $sum_of_types[$applicants_type] += 1;
            else 
                $sum_of_types[$applicants_type] = 1; 
        }
        return view('statistics.types', ['types_results'=>$types_results, 'sum_of_types'=>$sum_of_types]);
    }
    
    public function getCountriesStatistics(){
        $applications = Application::all();
        $applicants_type = 'Student';
        $countries_results;
        $continents;
        
        //TODO : check if the owner of application is: student, investigator or profesor
        foreach($applications as $application){
                if(isset($countries_results
                        [$application->country->continent->name]
                        [$application->country->name]
                        [$applicants_type]))
                    $countries_results[$application->country->continent->name][$application->country->name][$applicants_type] += 1;
                else 
                    $countries_results[$application->country->continent->name][$application->country->name][$applicants_type] = 1;
                
                if(isset($continents[$application->country->continent->name][$applicants_type]))
                    $continents[$application->country->continent->name][$applicants_type] += 1;
                else 
                    $continents[$application->country->continent->name][$applicants_type] = 1;

        }
        return view('statistics.countries', ['countries'=>$countries_results, 'continents'=>$continents]);
    }
    
    public function getMoneyInvestedStatistics(){
        $applications = Application::all();
        $applicants_type = 'Student';
        $money_invested;
        $total_money_invested;
        
        //TODO : check if the owner of application is: student, investigator or profesor
        foreach($applications as $application){

            foreach($application->utpSupportGrantedTypes as $utpSG){
                $amount = $utpSG->pivot->amount_granted;
                if(isset($money_invested[$application->unit->name][$applicants_type])){
                    $money_invested[$application->unit->name][$applicants_type] += $amount;
                }
                else{
                    $money_invested[$application->unit->name][$applicants_type] = $amount;
                }
                
                if(isset($total_money_invested[$applicants_type])){
                    $total_money_invested[$applicants_type] +=$amount;
                }else{
                    $total_money_invested[$applicants_type] = $amount;
                }
                
                
                
            }
        }
        return view('statistics.money', ['money_invested'=>$money_invested,'total_money_invested'=>$total_money_invested]);
    }
}