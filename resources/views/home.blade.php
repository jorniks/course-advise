<x-app-layout>
  <div class="relative min-h-screen bg-gray-100">
    <!-- ADD FORM -->
    <div class=" w-full h-full flex items-center justify-center px-1">
      <div class="mx-auto w-full max-w-3xl shadow bg-purple-500 py-14 shadow-3xl px-2 sm:px-5 bg-opacity-10 overflow-auto h-full scrollbar-hide">
        
        <form class="max-w-lg mx-auto" method="POST" action="{{ route('submitCourses') }}" x-data="{ yearPanel: 1 }">
          @csrf

          <div class="grid grid-rows-1 gap-y-6" x-show="yearPanel == 1">

            @foreach($coursesArray['ND1_1'] as $courses)
              <div class="flex flex-col max-w-xl">
                <div class="flex">
                  <label class="bg-gray-500 flex items-center justify-center rounded-l-md w-44 h-full text-gray-100 font-bold text-lg" data-aos="fade-right"> {{ $courses['code'] }} </label>
                  
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

          <div class="grid grid-rows-1 gap-y-6" x-show="yearPanel == 2">
            
            @foreach($coursesArray['ND1_2'] as $courses)
              <div class="flex flex-col max-w-xl">
                <div class="flex">
                  <label class="bg-gray-500 flex items-center justify-center rounded-l-md w-44 h-full text-gray-100 font-bold text-lg"> {{ $courses['code'] }} </label>
                  
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

          <div class="grid grid-rows-1 gap-y-6" x-show="yearPanel == 3">
            
            @foreach($coursesArray['ND2_1'] as $courses)
              <div class="flex flex-col max-w-xl">
                <div class="flex">
                  <label class="bg-gray-500 flex items-center justify-center rounded-l-md w-44 h-full text-gray-100 font-bold text-lg"> {{ $courses['code'] }} </label>
                  
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
              <label @click="yearPanel = 2" class="ring-1 ring-blue-600 px-8 py-2 rounded text-blue-600">Previous</label>
              
              <label @click="yearPanel = 4" class="bg-blue-600 px-8 py-2 rounded text-white">Next</label>
            </div>
          </div>

          <div class="grid grid-rows-1 gap-y-6" x-show="yearPanel == 4">
            
            @foreach($coursesArray['ND2_2'] as $courses)
              <div class="flex flex-col max-w-xl">
                <div class="flex">
                  <label class="bg-gray-500 flex items-center justify-center rounded-l-md w-44 h-full text-gray-100 font-bold text-lg"> {{ $courses['code'] }} </label>
                  
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
              <label @click="yearPanel = 3" class="ring-1 ring-blue-600 px-8 py-2 rounded text-blue-600">Previous</label>
              
              <label @click="yearPanel = 5" class="bg-blue-600 px-8 py-2 rounded text-white">Next</label>
            </div>
          </div>

          <div class="flex justify-between items-center" x-show="yearPanel == 5">

            <label @click="yearPanel = 4" class="ring-1 ring-blue-600 px-8 py-2 rounded text-blue-600">Previous</label>

            <button class="bg-blue-500 hover:bg-blue-600 duration-300 px-8 py-2 rounded text-white font-bold">Login</button>

          </div>

          
          
        </form>
      </div>
    </div>

    <!-- <i class='bx bx-user bx-tada'></i> -->
  </div>
</x-app-layout>