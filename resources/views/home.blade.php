
<x-app-layout>
  <div class="relative min-h-screen overflow-auto scrollbar-hide bg-gray-50">
    <form class="w-full" method="POST" action="{{ route('submitCourses') }}" x-data="{ yearPanel: 1 }">
      @csrf
      <section class="grid grid-cols-4 sm:divide-x-2 sm:divide-y-0 divide-y-2" x-show="yearPanel == 1">
        <section class="col-span-4 sm:col-span-2 px-2 sm:px-8 pb-8 pt-16">
          <label class="font-bold text-2xl">YEAR 1 - SEMESTER 1</label>
          <div class="grid grid-rows-1 gap-y-4 mt-5">
            @foreach($coursesArray['ND1_1'] as $courses)
              <div class="grid">
                <div class="flex">
                  <label class="bg-blue-400 flex items-center justify-center rounded-l-md w-44 h-full text-gray-100 font-bold text-lg" data-aos="fade-right"> {{ $courses['code'] }} </label>
                  
                  <select name="{{ $courses['sect'] . '_' . str_replace(' ', '_', $courses['code']) }}" class="rounded-r-md outline-0 w-full" data-aos="fade-left">
                    <option value="" disabled selected>Select Grade</option>
                    <option value="A">A</option>
                    <option value="AB">AB</option>
                    <option value="B">B</option>
                    <option value="BC">BC</option>
                    <option value="C">C</option>
                    <option value="CD">CD</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                  </select>
                </div>
                <small class="text-xs" data-aos="fade-up"> {{ $courses['title'] }} </small>
              </div>
            @endforeach
          </div>
        </section>
        
        <section class="col-span-4 sm:col-span-2 px-2 sm:px-8 pb-8 pt-6 sm:pt-16">
          <label class="font-bold text-2xl">YEAR 1 - SEMESTER 2</label>
          <div class="grid grid-rows-1 gap-y-4 mt-5">
            @foreach($coursesArray['ND1_2'] as $courses)
              <div class="grid">
                <div class="flex">
                  <label class="bg-blue-400 flex items-center justify-center rounded-l-md w-44 h-full text-gray-100 font-bold text-lg" data-aos="fade-right"> {{ $courses['code'] }} </label>
                  
                  <select name="{{ $courses['sect'] . '_' . str_replace(' ', '_', $courses['code']) }}" class="rounded-r-md outline-0 w-full" data-aos="fade-left">
                    <option value="" disabled selected>Select Grade</option>
                    <option value="A">A</option>
                    <option value="AB">AB</option>
                    <option value="B">B</option>
                    <option value="BC">BC</option>
                    <option value="C">C</option>
                    <option value="CD">CD</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                  </select>
                </div>
                <small class="text-xs" data-aos="fade-up"> {{ $courses['title'] }} </small>
              </div>
            @endforeach
            
            <div class="text-right my-8">
              <label @click="yearPanel = 2" class="bg-blue-600 px-8 py-2 rounded text-white">Next</label>
            </div>
          </div>
        </section>
      </section>

      <section class="grid grid-cols-4 sm:divide-x-2 sm:divide-y-0 divide-y-2" x-show="yearPanel == 2">
        <section class="col-span-4 sm:col-span-2 px-2 sm:px-8 pb-8 pt-16">
          <label class="font-bold text-2xl">YEAR 2 - SEMESTER 1</label>
          <div class="grid grid-rows-1 gap-y-4 mt-5">
            @foreach($coursesArray['ND2_1'] as $courses)
              <div class="grid">
                <div class="flex">
                  <label class="bg-blue-400 flex items-center justify-center rounded-l-md w-44 h-full text-gray-100 font-bold text-lg"> {{ $courses['code'] }} </label>
                  
                  <select name="{{ $courses['sect'] . '_' . str_replace(' ', '_', $courses['code']) }}" class="rounded-r-md outline-0 w-full">
                    <option value="" disabled selected>Select Grade</option>
                    <option value="A">A</option>
                    <option value="AB">AB</option>
                    <option value="B">B</option>
                    <option value="BC">BC</option>
                    <option value="C">C</option>
                    <option value="CD">CD</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                  </select>
                </div>
                <small class="text-xs"> {{ $courses['title'] }} </small>
              </div>
            @endforeach
          </div>
        </section>
        
        <section class="col-span-4 sm:col-span-2 px-2 sm:px-8 pb-8 pt-6 sm:pt-16">
          <label class="font-bold text-2xl">YEAR 2 - SEMESTER 2</label>
          <div class="grid grid-rows-1 gap-y-4 mt-5">
            @foreach($coursesArray['ND2_2'] as $courses)
              <div class="grid">
                <div class="flex">
                  <label class="bg-blue-400 flex items-center justify-center rounded-l-md w-44 h-full text-gray-100 font-bold text-lg"> {{ $courses['code'] }} </label>
                  
                  <select name="{{ $courses['sect'] . '_' . str_replace(' ', '_', $courses['code']) }}" class="rounded-r-md outline-0 w-full">
                    <option value="" disabled selected>Select Grade</option>
                    <option value="A">A</option>
                    <option value="AB">AB</option>
                    <option value="B">B</option>
                    <option value="BC">BC</option>
                    <option value="C">C</option>
                    <option value="CD">CD</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                  </select>
                </div>
                <small class="text-xs"> {{ $courses['title'] }} </small>
              </div>
            @endforeach
            
            <div class="flex justify-between items-center my-8">
              <label @click="yearPanel = 1" class="ring-1 ring-blue-600 px-8 py-2 rounded text-blue-600">Previous</label>
              
              <label @click="yearPanel = 3" class="bg-blue-600 px-8 py-2 rounded text-white">Next</label>
            </div>
          </div>
        </section>
      </section>

      <section class="flex justify-between items-center max-w-md mx-auto h-screen" x-show="yearPanel == 3">
        <label @click="yearPanel = 2" class="ring-1 ring-blue-600 px-8 py-2 rounded text-blue-600">Previous</label>

        <button class="bg-blue-500 hover:bg-blue-600 duration-300 px-8 py-2 rounded text-white font-bold">Submit</button>
      </section>
    </form>
  </div>
</x-app-layout>
