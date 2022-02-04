
<x-app-layout>
  <div class="relative min-h-screen scrollbar-hide bg-gray-50">
    <div class="h-screen" style="background:url('{{ url('science-school.jpg') }}'); background-repeat: no-repeat; background-size: cover;">

      <div class="z-10 text-white bg-black bg-opacity-40 h-full w-full flex items-center justify-center"> 
        @if(Request::getPathInfo() == '/search')
          <livewire:get-recommendation />
        @else
          <div class="grid gap-y-5" data-aos="zoom-in">
            <a href="{{url('/recommendation')}}" class="bg-blue-600 px-6 py-3 text-white font-semibold text-center rounded-md">Get Recommendation</a>
            <a href="{{url('/search')}}" class="bg-blue-600 px-6 py-3 text-white font-semibold rounded-md text-center">Search Results</a>
            @if(session()->has('toastSuccess'))
              {!! session()->get('toastSuccess') !!}
            @endif
          </div>
        @endif

      </div>
    </div>
  </div>
</x-app-layout>
