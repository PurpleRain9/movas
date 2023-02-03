<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuideAttachController extends Controller
{
    //

    public function downloadMyanmar()
    {
      $file= public_path(). "/user_guide/MOVAS User Guide (Myanmar).pdf";



      $headers = [

          'Content-Type' => 'application/pdf',

      ];



      return response()->download($file, 'MOVAS User Guide (Myanmar).pdf', $headers);
  }

  public function downloadEnglish()
    {
      $file= public_path(). "/user_guide/MOVAS User Guide (English).pdf";

      

      $headers = [

          'Content-Type' => 'application/pdf',

      ];

      

      return response()->download($file, 'MOVAS User Guide (English).pdf', $headers);
  }
}


