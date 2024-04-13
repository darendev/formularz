<?php

namespace App\Services;
use Illuminate\Http\Request;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Exception;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;


class dataEditor
{
    /**
     * Create a new class instance.
     */


     public function removeUploadedFile($file)
     {   
         $filePath = 'uploads/' . $file; 
 
         if (Storage::exists($filePath)) {
 
             Storage::delete($filePath);         
         }
 
     }
     
 
     public function readFileNameFromCSV($id){
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
 
 
     public function saveRowToFileCSV($path, array $data){          
                    
        // Sprawdź, czy plik istnieje
        if (Storage::exists($path)) {
            // Otwórz istniejący plik w trybie dodawania ('a')          
          
            $handle =  fopen(storage_path('app/' . $path), 'a');

        } else {          
            // Utwórz nowy plik, jeśli nie istnieje
            $handle = fopen(storage_path('app/' .$path), 'w');
            //  nagłówki
            fputcsv($handle, ['imie', 'nazwisko', 'email','telefon','zalacznik']);
        }

        // Dodaj nowy wiersz danych
        fputcsv($handle, $data);

        // Zamknij plik
        fclose($handle);     
   
    }    



    public function readFileCSV($path){

        $CSVFilePath = storage_path('app/' . $path);
       
        $records = [];

        // Sprawdź, czy plik istnieje
        if (file_exists( $CSVFilePath)) {            
            try {
                // Odczytaj zawartość pliku CSV
                $reader = Reader::createFromPath( $CSVFilePath, 'r');
                    // Ustawienie nagłówków
                $reader->setHeaderOffset(0);
                    // Pobierz wszystkie rekordy, włącznie z pustymi
                $records = iterator_to_array($reader->getRecords());                        

            } catch (Exception $e) {    
                              
            }
        }      
        return  $records;

    }



    public function saveManyRowsToFileCSV($csvPath , $csvRecords){          
                   
        foreach ($csvRecords as $record) {
            $this->saveRowToFileCSV($csvPath, $record);
        }
   
    }   
    
    
    public function upadeRow($id,$data){   

        $csvPath = 'baza.csv';    

        $csvRecords = $this->readFileCSV( $csvPath);     

        $csvRecords[$id]['imie'] = $data['imie'];

        $csvRecords[$id]['nazwisko'] = $data['nazwisko'];

        $csvRecords[$id]['email'] = $data['email'];

        $csvRecords[$id]['telefon'] = $data['telefon'];

        if( $csvRecords[$id]['zalacznik']  != $data['zalacznik']){
            if (Storage::exists('uploads/'.$csvRecords[$id]['zalacznik'])) {

                $staraNazwa = 'uploads/'.$csvRecords[$id]['zalacznik'];
           
                $nowaNazwa = 'uploads/'.$data['zalacznik'];

                Storage::move($staraNazwa, $nowaNazwa);                

            }   

            $csvRecords[$id]['zalacznik'] = $data['zalacznik'];
            
        }      
        
        if (Storage::exists($csvPath)) { 

            Storage::delete($csvPath);

        }   

        $this->saveManyRowsToFileCSV($csvPath , $csvRecords);             
        
    }

    

    public function removeRowFromCSV($id){   

        $csvPath = 'baza.csv';    

        $csvRecords = $this->readFileCSV( $csvPath);     

        unset($csvRecords[$id]);

        if (Storage::exists($csvPath)) { 

            Storage::delete($csvPath);

        }   

        $this->saveManyRowsToFileCSV($csvPath , $csvRecords);             
        
    }



}
