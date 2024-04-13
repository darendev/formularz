<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\dataEditor;


// Kontroler przekazuje dane jednego wiersza pliku csv do wyswietlenia w edycji


class EdycjaController extends Controller
{

    public function getRow($id){
      
        $id = intval($id);

        $csvPath = 'baza.csv';    

        $dataEditor = new dataEditor();

        $csvRecords = $dataEditor->readFileCSV( $csvPath);            

        if( !empty($csvRecords[$id])){

            $csvRecords[$id]['id'] = $id;
            
            return view('edycja', $csvRecords[$id]);  

        }
        else{
            return redirect()->back()->with('success', 'Wystąpił błąd edycji wpisu');
        }

        

        


         
    }
}


