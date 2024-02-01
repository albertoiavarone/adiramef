<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Models\Production\Machine;
use App\Models\Production\MachineType;
use App\Models\Production\MachineInfo;
use App\Models\Production\Builder;
use App\Models\Production\Provider;
use App\Models\Production\Work;
use App\Models\Commercial\Order;
use App\Models\Commercial\Customer;

use App\Classes\SMS;
use App\Classes\Users;
use Image;
use \Carbon\Carbon;
use Illuminate\Support\Str;
use App\Classes\Machines;
use App\Classes\Sync;
use App\Classes\MachineLogs;
use App\Classes\Tokens;
use Cache;

use App\Classes\Builders\PackSolution;

use PDF;
use setasign\Fpdi\Tcpdf\Fpdi;
use setasign\Fpdi\PdfReader;
use Elibyy\TCPDF\Facades\TCPDF;
use Smalot\PdfParser\Parser;

//composer require setasign/fpdi-fpdf
//composer remove elibyy/tcpdf-laravel
//composer require smalot/pdfparser

class TestController extends Controller
{

    public function __construct(){
        $this->SMS = new SMS();
        $this->users = new Users();
        $this->machine = new Machines();
        $this->MachineLogs = new MachineLogs();
        $this->sync = new Sync();
        $this->Token = new Tokens();
        $this->PackSolution = new PackSolution();
    }

    public function test(){

        return view('test');
    }

    public function test_post(Request $request){


        $file = $request->file('uploaded_file');
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileNameOnly = pathinfo($filename, PATHINFO_FILENAME);
        $time = time();
        $completePdf = str_replace(' ', '_', $fileNameOnly).'-'.date('m-d-Y-s', $time).'Original.'.$extension;
        $dir = 'cedolini\\'.date('Y');
        $save = $file->storeAs($dir, $completePdf);

        $this->splitPdf($completePdf,$dir);

        dd('stooop');
    }


    public function splitPdf ($filename,$dir) {

        $pdf = new Fpdi();
        $path = Storage::disk('local')->path('public\\'.$dir.'\\'.$filename);
        $count = $pdf->setSourceFile($path);
        //dd($path,'$count',$count);
        $count = 1;
        for ($i = 1; $i <= $count; $i++) {

            $newPdf = new Fpdi();
            $newPdf->AddPage();
            $newPdf->setSourceFile($path);
            $newPdf->useTemplate($newPdf->importPage($i));
            //dump($i,$newPdf);

            try {

            $newFile =Storage::disk('local')->path( 'public\\'.$dir.'\\'."Split".'_'.$i.".pdf") ;
            //dump('$newFilename '.$newFilename);
            $newPdf->Output($newFile, "F");

            $parser = new Parser();
            $file_pdf = $parser->parseFile($newFile);
            $text = $file_pdf->getText();
            dump($text);

            } catch (\Exception $e){
                //dump(response()->json(['status' => false, 'message' => $e]));
                return response()->json(['status' => false, 'message' => $e]);

            }


        }
    }
}
