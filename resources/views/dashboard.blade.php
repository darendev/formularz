<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }} 
        </h2>
    </x-slot>


    <style>
    #tab_container{
        width:80%;
        display:block;
        margin: auto;
        margin-bottom:100px;
        margin-top:30px;
    }
    .dataTables_wrapper .dataTables_length select {    
        padding-right: 30px;    
    }

    select {        
        background-position: right;      
    }
    #example{
        margin-top:20px;
    }

    .uploaded_file_link{
        text-decoration: underline;
        text-underline-position: under;
    }
    .uploaded_file_link:hover{
        color: #d32b2b;
    }    
    .font-size{
        font-size: 0.775em;
    }   
    .link_margin{
        margin-left:10px;
    }

    .sorting:nth-of-type(7) {
        background-image: none !important; 
        background-color:none!important;
     }

     .color-green{
        color:green;
     }

     .p-6{
        padding-top:0px;
        padding-bottom:0px;
     }

     .bg-white{
        padding-top: 20px;
     }

     
</style>    


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                {{ __("Jesteś zalogowany, możesz edytować i przeglądać plik CSV jeżeli przynajmniej 1 formularz został wysłany") }}
    </div>


                  
                    
                </div>

                <!--
                Informacja zwrotna edycji dokumentu    
                 -->
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            {{ session('success') }}
                       </div>
                    @endif

                    @if(session('message'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">                      
                             {{ session('message') }} 
                        </div>
                    @endif

                </div>      


<div id="tab_container"> 


<table id="example" class="display" style="width:100%">
    <thead>
           <tr> 
                <th>ID</th>
                <th>Imie</th>
                <th>Nazwisko</th>
                <th>email</th>
                <th>Telefon</th>
                <th>Załącznik</th>    
                <th></th>            
            </tr>
    </thead>

        <tbody>

        @foreach($records as $index => $record)
            <tr>
                <td>{{ htmlspecialchars_decode($index) }}</td>
                <td>{{ htmlspecialchars_decode($record['imie']) }}</td>
                <td>{{ htmlspecialchars_decode($record['nazwisko']) }}</td>
                <td>{{ htmlspecialchars_decode($record['email']) }}</td>
                <td>{{ htmlspecialchars_decode($record['telefon']) }}</td>
                <td> <a class="uploaded_file_link font_size" href = "./plik/{{ $index }}" > {{ htmlspecialchars_decode($record['zalacznik']) }}</a>  </td>           
                <td> 
                    <a class="uploaded_file_link font-size" href = "./edycja/{{ $index }}" > edycja</a> 
                    <a class="uploaded_file_link font-size link_margin" href = "./usun/{{ $index }}" > usun</a>
                </td>  
            </tr>
        @endforeach



        </tbody>    
</table>

</div>

    <script>

        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "sProcessing":   "Przetwarzanie...",
                    "sLengthMenu":   "Pokaż _MENU_ pozycji",
                    "sZeroRecords":  "Nie znaleziono pasujących pozycji, plik CSV jest pusty lub nie istnieje",
                    "sInfo":         "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
                    "sInfoEmpty":    "Pozycji 0 z 0 dostępnych",
                    "sInfoFiltered": "(filtrowanie spośród _MAX_ dostępnych pozycji)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Szukaj:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Pierwsza",
                        "sPrevious": "Poprzednia",
                        "sNext":     "Następna",
                        "sLast":     "Ostatnia"
                    },
                    "oAria": {
                        "sSortAscending":  ": aktywuj, by posortować kolumnę rosnąco",
                        "sSortDescending": ": aktywuj, by posortować kolumnę malejąco"
                    }
                }
            });
        });

    </script>


            </div>
        </div>
    </div>

    



</x-app-layout>
