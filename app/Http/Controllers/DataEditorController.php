<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\dataEditor;
use Illuminate\Support\Facades\Validator;


class DataEditorController extends Controller
{

    public function removeForm($id)    
    {     
           
            $id = intval($id);

            $dataEditor = new dataEditor();

            $FileNameFromCSV = $dataEditor->readFileNameFromCSV($id);            
           
            if(!empty($FileNameFromCSV)){   

                $dataEditor->removeUploadedFile($FileNameFromCSV);
                      
            }     

            $dataEditor->removeRowFromCSV($id);    

            return redirect()->back()->with('success', 'Wpis został usunięty.');

    }

    private function specialChars($field){
        // znaki specjalne
        return htmlspecialchars(trim($field));       
    }

    public function upade(Request $request)    
    {     

            $validator = Validator::make($request->all(), [
                'imie' => 'required|string|max:255',
                'nazwisko' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telefon' => 'nullable|string|max:255', 
                'zalacznik' => 'nullable|string|max:255', 
                'id' => 'required|integer', 
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Wprowadzono błędne dane. Sprawdź formularz i spróbuj ponownie.');
            }           
     
            $data = [];
            $data['imie'] = $this->specialChars($request->input('imie'));
            $data['nazwisko'] = $this->specialChars($request->input('nazwisko'));
            $data['email'] = $this->specialChars($request->input('email'));
            $data['telefon'] = $this->specialChars($request->input('telefon'));
            $data['zalacznik'] = $this->specialChars($request->input('zalacznik'));
            $id =  intval($request->input('id'));
          
            $dataEditor = new dataEditor();
            $FileNameFromCSV = $dataEditor->upadeRow($id,$data);        
           
           return redirect()->route('dashboard')->with('message', 'Wiersz został zapisany');
  
    }
    

}
