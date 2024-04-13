<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;

use League\Csv\Statement;
use League\Csv\Exception;


class CsvController extends Controller
{

    
    public function showCSV()
    {
        // Ścieżka do pliku CSV na serwerze
        $filePath = storage_path('app/baza.csv');
        $records = [];
        
        // Sprawdź, czy plik istnieje
        if (!file_exists($filePath)) {        
            $records = [];
        } else {
            try {
                // Odczytaj zawartość pliku CSV
                $reader = Reader::createFromPath($filePath, 'r');
    
                // Ustawienie nagłówków
                $reader->setHeaderOffset(0);
    
                // Pobierz wszystkie rekordy, włącznie z pustymi
                $records = iterator_to_array($reader->getRecords());
            } catch (Exception $e) {            
                $records = [];
            }
        }    
    
        return view('dashboard', compact('records'));
    }


}    
     
     
