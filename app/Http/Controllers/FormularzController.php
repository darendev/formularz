<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class FormularzController extends Controller
{

    private $data_file = 'baza.csv';


    private function specialChars($field){
        // znaki specjalne
        return htmlspecialchars(trim($field));       
    }


    private function validation(Request $request){        
        // walidacja danych z formularza

        $data = array();  

        // imie
        $imie = $this->specialChars( $request->input('imie'));      
        if( !empty($imie) && strlen($imie)<255 ){
              $data['imie'] = $imie;
        }
        else{
            throw new Exception('Błąd poprawności danych dla pola imię');
        }

        // nazwisko
        $nazwisko = $this->specialChars( $request->input('nazwisko'));      
        if( !empty($nazwisko) && strlen($nazwisko)<255 ){
              $data['nazwisko'] = $nazwisko;
        }
        else{
            throw new Exception('Błąd poprawności danych dla pola nazwisko');
        }

        // email
         $email = $this->specialChars( $request->input('email'));      
        if( !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email)<255 ){             
            $data['email'] = $email;                         
        }
        else{
            throw new Exception('Błąd poprawności danych dla pola email');
        }

         // telefon       
        $telefon = preg_replace("/[^0-9]/", '', $this->specialChars($request->input('telefon')) );    
        $data['telefon'] = '';
        if( !empty($telefon)){
            if( strlen($telefon)<15 ){  
                $data['telefon'] = $telefon;
            }
            else{
                throw new Exception('Błąd poprawności danych dla numeru telefonu');
            }
        }         
                
        //zalacznik
        $validator = Validator::make($request->all(), [
            'file' => 'mimes:png,jpg,pdf|max:2048'
        ]);
        $data['file'] = '';
        if ($request->hasFile('file')) {

            if ($validator->passes()) {              
                // Zapisanie nazwy pliku do tablicy
                $data['file'] = $request->file('file')->getClientOriginalName();
            }          
            else{
                throw new Exception('Przesłano nieprawidłowy załącznik');                
            }

        }    

        return $data;
      
    }


    private function saveUploadedFile(Request $request) {
        
        $fileName = '';

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Utwórz katalog, jeśli nie istnieje
            $directory = 'uploads'; // Nazwa katalogu
            Storage::makeDirectory($directory);
    
            // Wygeneruj unikalną nazwę pliku
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
    
            // Zapisz plik w katalogu storage/uploads
            $filePath = $file->storeAs($directory, $fileName);         
          
        } 
      
        return $fileName;
    }
  

    private function saveCSV(Request $request, array $data){          
                   
            // Sprawdź, czy plik istnieje
            if (Storage::exists($this->data_file)) {
                // Otwórz istniejący plik w trybie dodawania ('a')
                $handle = fopen(storage_path('app/' . $this->data_file), 'a');
            } else {
                // Utwórz nowy plik, jeśli nie istnieje
                $handle = fopen(storage_path('app/' . $this->data_file), 'w');
                //  nagłówki
                fputcsv($handle, ['imie', 'nazwisko', 'email','telefon','zalacznik']);
            }
            
            // zapisanie pliku
            if( !empty($data['file'] )){
                $data['file'] = $this->saveUploadedFile($request);
            }

            // Dodaj nowy wiersz danych
            fputcsv($handle, $data);
        
            // Zamknij plik
            fclose($handle);
        
            echo "Formularz został wysłany";   
       
    }    


   
    public function zapiszDane(Request $request)
    {

        try {

            $data = $this->validation($request);
            $this->saveCSV( $request, $data );

            

        } catch (Exception $e) {

            echo  $e->getMessage(), "\n";

        }

    }


}
