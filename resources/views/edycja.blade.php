<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edycja') }} 
        </h2>
    </x-slot>

   <style>
          .upload-center{
              width:90%;
              display:block;
              margin: auto;
              margin-bottom:100px;
              margin-top:30px;
              min-height:500px;
          }

         body{
              background-color: rgb(243 244 246);
          }
          .max-size{
              font-size: 1.1rem;
              font-weight: 500;
              padding-bottom: 3px;    
              margin-bottom:30px;                   
          }  
          .form-zad{
            margin-left:20px;          
          }
          .form-header-zad{
            padding-bottom: 40px;         
          }
          .form-style{
              background-color: white;
              padding: 20px;
              border-radius: 7px;
          }
          .send-button{
              margin-top:30px; 
          }        
         .p-6{
              padding-top:0px;
              padding-bottom:0px;
          }
          .bg-white{
              padding-top: 20px;
          }    
          .top-pad{
            padding-top:0px;
          }      
          .send-button:hover{
            cursor: pointer;
          }
       
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden top-pad  sm:rounded-lg">
             


            <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden top-pad  sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    Wiersz pliku CSV numer <?php echo $id; ?>
                    </div>                   
                </div>

                <!--
                Informacja zwrotna edycji dokumentu    
                 -->
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('error'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            {{ session('error') }}
                       </div>
                    @endif
                </div>            



            

<div id="form-container">                 

      <form class="max-w-sm mx-auto" enctype="multipart/form-data"  action="{{ route('aktualzacja-wpisu') }}" method="post" >
          @csrf                        

          <div class="form-style">        


                        <div class="mb-5">    
        <label for="imie" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imię</label>
        <input value="<?php echo $imie; ?>" type="text" id="imie" name="imie" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"  />
      </div>


      <div class="mb-5">    
        <label for="nazwisko" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nazwisko</label>
        <input value="<?php echo $nazwisko; ?>" type="text"  id="nazwisko" name="nazwisko" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"  />
      </div>


      <div class="mb-5">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adres email</label>
        <input value="<?php echo $email; ?>" type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"  />
      </div>


      <div class="mb-5">    
        <label for="telefon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numer telefonu</label>
        <input value="<?php echo $telefon; ?>" type="text" id="telefon" name="telefon" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
      </div>


      <div class="mb-5">    
        <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nazwa załącznika</label>
        <input value="<?php echo $zalacznik; ?>" type="text" id="file" name="zalacznik" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
      </div>


      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <input type="submit" value="Zapisz" class="send-button text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >
      

      </div>      

    </form>


            </div>
        </div>
    </div>

    



</x-app-layout>
