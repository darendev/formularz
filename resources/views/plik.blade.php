<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Załącznik') }} 
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
        .center{
            margin:0 auto;
        }

    
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
             
                <div class="upload-center">
                @if (Str::startsWith($mimeType, 'image/'))
                   <img class="center" src="data:{{ $mimeType }};base64,{{ base64_encode($content) }}" alt="Obraz">
                @elseif ($mimeType === 'application/pdf')
                    <embed  class="center" src="data:application/pdf;base64,{{ base64_encode($content) }}" type="application/pdf" width="100%" height="600px">
                @else
                    <p>Plik nie istnieje</p>
                @endif
                </div>

            </div>
        </div>
    </div>

    



</x-app-layout>
