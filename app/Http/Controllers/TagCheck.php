<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TagResult;
use Illuminate\Http\Request;

class TagCheck extends Controller
{
    public static function index(Request $request)
    {
        if ($request->key == 'show') {
            $data   =   TagResult::where('chipcode', 'LIKE', "%" . $request->code . "%")->first();

            if (!$data) {
                $return['status']   =   400 ;
                $return['msg']      =   'No data found' ;
                return $return ;
            }

            $payload    =   [
                'bib'           =>  $data->bib ,
                'firstName'     =>  $data->firstName ,
                'lastName'      =>  $data->lastName ,
                'time'          =>  $data->finishtime ,
                'contest'       =>  strtoupper($data->contest . ' ' . $data->category . ' ' . $data->gender)  ,
                'pace'          =>  'PACE ' . $data->pace
            ] ;

            $return['status']   =   200 ;
            $return['msg']      =   'Data found' ;
            $return['data']     =   $payload ;
            return $return ;

        } else {
            return view('index') ;
        }
    }

    public static function findall()
    {
        $data   =   TagResult::all() ;

        if (!$data) {
            $return['status']   =   400 ;
            $return['msg']      =   'No data found' ;
            return $return ;
        }

        $return['status']   =   200 ;
        $return['msg']      =   'Data found' ;
        $return['data']     =   $data ;
        return $return ;
    }

    public static function update(Request $request)
    {
        $data   =   $request->data ;

        foreach ($data as $key => $value) {
            $update =   TagResult::where('chipcode', $value['chipcode'])->update([
                'finishtime'    =>  $value['finishtime'] ,
                'chiptime'      =>  $value['chiptime'] ,
                'pace'          =>  $value['pace'] ,
            ]) ;
        }

        if ($update) {
            $return['status']   =   200 ;
            $return['msg']      =   'Data updated' ;
            $return['data']     =   $data ;
        } else {
            $return['status']   =   400 ;
            $return['msg']      =   'Data failed to update' ;
        }

        return $return ;
    }

    public static function store(Request $request)
    {
        $data   =   $request->data ;

        foreach ($data as $key => $value) {
            $insert             =   new TagResult ;
            $insert->bib        =   $value['bib'] ;
            $insert->firstName  =   $value['firstName'] ;
            $insert->lastName   =   $value['lastName'] ;
            $insert->gender     =   $value['gender'] ;
            $insert->type       =   $value['type'] ;
            $insert->dob        =   $value['dob'] ;
            $insert->age        =   $value['age'] ;
            $insert->contest    =   $value['contest'] ;
            $insert->race       =   $value['race'] ;
            $insert->chipcode   =   $value['chipcode'] ;

            $insert->save() ;
        }

        if ($insert) {
            $return['status']   =   200 ;
            $return['msg']      =   'Data inserted' ;
            $return['data']     =   $data ;
        } else {
            $return['status']   =   400 ;
            $return['msg']      =   'Data failed to insert' ;
        }

        return $return ;
    }
}
