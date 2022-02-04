
<x-app-layout>
  <div class="relative min-h-screen scrollbar-hide bg-gray-50">
    <div class="h-screen" style="background:url('{{ url('science-school.jpg') }}'); background-repeat: no-repeat; background-size: cover;">
      <div class="absolute right-0">
        <img src="{{url('fptb-logo.png')}}" alt="Poly Logo" class="h-16 rounded-bl-3xl" data-aos="fade-up-right"/>
      </div>

      <div class="z-10 text-white bg-black bg-opacity-40 h-full w-full flex items-center justify-center"> 
        <div class="" data-aos="zoom-in">
          <a href="{{url('/recommendation')}}" class="bg-blue-500 px-8 py-3 text-white font-semibold rounded-md">Get Recommendation</a>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
