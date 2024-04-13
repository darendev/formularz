<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Plik extends Controller
{
    // wyswietla przeslany plik

    private function readFileNameFromCSV($id){
        $CSVFilePath = storage_path('app/baza.csv');
        $uploaded_file = '';

        // Sprawdź, czy plik istnieje
        if (file_exists( $CSVFilePath)) {            
            try {
                // Odczytaj zawartość pliku CSV
                $reader = Reader::createFromPath( $CSVFilePath, 'r');
                    // Ustawienie nagłówków
                $reader->setHeaderOffset(0);
                    // Pobierz wszystkie rekordy, włącznie z pustymi
                $records = iterator_to_array($reader->getRecords());              

                if(isset( $records[$id]['zalacznik'] ) ){
                     $uploaded_file = $records[$id]['zalacznik'];
                }
               

            } catch (Exception $e) {    
                              
            }
        }      
        return  $uploaded_file;
    }



    public function getFile($id)
    {    
      
       $uploadet_file_name =  $this->readFileNameFromCSV($id);
       $filePath = 'uploads/' . $uploadet_file_name;

       $content = '';
       $mimeType = '';

       if (Storage::exists($filePath)) {
            $content = Storage::get($filePath);
            $mimeType =  Storage::mimeType($filePath);    
        }     

       return view('plik', ['content' => $content,'mimeType' => $mimeType]);

    }



}
