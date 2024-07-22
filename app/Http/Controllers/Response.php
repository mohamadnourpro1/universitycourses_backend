<?php

namespace App\Http\Controllers;

trait Response
{
  public function apiresponse($data=null,$message=null,$status=null){
    $array = [
        'data'=> $data,
        'message'=>$message,
        'status'=>$status,
    ];
    return response($array);
}

}
