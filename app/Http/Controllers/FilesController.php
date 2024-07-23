<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;

class FilesController extends Controller
{
  use Response;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = Files::all();
        return $this->apiresponse($files,'all data',200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = Files::create([
          'title' => $request->title,
          'lecture_number' => $request->lecture_number,
          'course_code' => $request->course_code,
          'file_path' => $request->file_path,
        ]);
        return $this->apiresponse($file,'file has been added',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = Files::find($id);
        if($file){
          return $this->apiresponse($file,'file has been found',200);
        }
        return $this->apiresponse(null,'file not found',404);
        
    }
    
    public function showlevel(Request $request)
    {
        $files = Files::query();
        $file = $files->where('course_code','LIKE',$request->course_code.'%')->get();
        if($file->isNotEmpty()){
          return $this->apiresponse($file,'file has been found',200);
        }
        return $this->apiresponse(null,'file not found',404);
        
    }
    public function showseason(Request $request)
    {
        $files = Files::query();
        $search_char = $request->input('course_code'); // القيمة المرسلة في الطلب
        $file = $files->whereRaw('SUBSTRING(course_code, 2, 1) = ?', [$search_char])->get();
        if($file->isNotEmpty()){
            return $this->apiresponse($file, 'file has been found', 200);
        }
        return $this->apiresponse(null, 'file not found', 404);
    }
    public function showfile(Request $request)
    {
        $files = Files::query();
        $search_chars = $request->input('course_code'); // القيمة المرسلة في الطلب
        $file = $files->whereRaw('RIGHT(course_code, 2) = ?', [$search_chars])->get();
        if($file->isNotEmpty()){
            return $this->apiresponse($file, 'file has been found', 200);
        }
        return $this->apiresponse(null, 'file not found', 404);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Files  $files
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Files $files)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function destroy(Files $files)
    {
        //
    }
}
