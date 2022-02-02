<x-app-layout>
  <div class="relative min-h-screen bg-gray-100" x-data="{ unit: {{ $gradeScoreValues['unitScore'] }}, course: '{{ $gradeScoreValues['course'] }}', showEmailModal: false }">
    <div class="sm:grid grid-cols-10 h-screen">
      <section class="sm:col-span-3 p-6 flex flex-col justify-center">
        <canvas class="mx-7" id="chartDoughnut"></canvas>

        <div class="text-center py-5">
          <section class="my-4">
            <label class="text-4xl sm:text-6xl font-black" x-text='unit'></label> units
            <h5 class="sm:text-lg font-semibold" x-text='course'></h5>
          </section>

          <section class="flex items-center justify-between text-sm sm:text-base">
            <div class="cursor-pointer grid" @click="unit = {{ $gradeScoreValues['unitScore'] }}; course = '{{ $gradeScoreValues['course'] }}'">
              {{ $gradeScoreValues['unitScore'] }}
              <span class="-mt-1">{{ $gradeScoreValues['course'] }}</span>
            </div>

            <?php
              array_walk($gradeScoreValues, function($value, $key) {
                if(is_array($value)) {
            ?>
                  <div class="cursor-pointer grid" @click="unit = {{ $value['unitScore'] }}; course = '{{ $value['course'] }}'">
                    {{ $value['unitScore'] }}
                    <span class="-mt-1">{{ $value['course'] }}</span>
                  </div>
            <?php
                }
              });
            ?>
          </section>
        </div>
      </section>

      <section class="sm:col-span-7 p-4 sm:px-24 bg-gray-200 flex items-center">
        <div class="">
          Hello,
          <p class="py-3">
            After analyzing your performance over the course of four (4) semesters, it is observed that you perform better in courses related to {{ $gradeScoreValues['course'] }}. Therefore you are adviced to go for {{ $gradeScoreValues['course'] }} related courses such as {{ $gradeScoreValues['suggestion1'] }} or {{ $gradeScoreValues['suggestion2'] }}.
          </p>
          <p class="">
            With an average score of {{ $gradeScoreValues['unitScore'] }} units in {{ $gradeScoreValues['course'] }}, diligently consider the suggested courses above and go for one that best suits your inner drive.
          </p>
          <p class="py-3 sm:text-right font-bold uppercase">
            Best Wishes
          </p>
        </div>
      </section>
    </div>

    <div class="modal fixed left-0 top-0 px-3 w-full h-full justify-center items-center overflow-auto z-30 bg-gray-900 bg-opacity-20" x-transition x-bind:class="(showEmailModal) ? 'flex' : 'hidden'">
      <div class="modal-container bg-white w-full md:max-w-sm mx-auto shadow-lg z-10 overflow-y-auto">
        <div class="modal-content py-4 text-left px-2 md:px-5 bg-blue-900 bg-opacity-10">
          <!--Title-->
          <div class="flex justify-end items-center pb-8">
            <div class="modal-close cursor-pointer z-10" @click="showEmailModal = false">
              <i class="fas fa-times-circle text-xl hover:text-red-600 duration-300"></i>
            </div>
          </div>

          <!--Body-->
          <form class="grid grid-rows-1 gap-4" method="POST">
        
            <div class="text-gray-500 relative focus-within:text-gray-700">
              <div class="absolute left-2 top-1.5 text-xl text-gray-700">
                <i class="far fa-user"></i>
              </div>
              <input type="text" class="focus:bg-white focus:ring-1 focus:ring-black pl-10 pr-2 py-2 w-full placeholder-gray-700" placeholder="First Name" name="studentName" required>
            </div>

            <div class="text-gray-500 relative focus-within:text-gray-700">
              <div class="absolute left-2 top-1.5 text-xl text-gray-700">
                <i class="far fa-envelope"></i>
              </div>
              <input type="text" class="focus:bg-white focus:ring-1 focus:ring-black pl-10 pr-2 py-2 w-full placeholder-gray-700" placeholder="Your Email" name="studentEmail" required>
            </div>

            <button class="bg-green-500 hover:bg-green-600 duration-300 w-full py-2 my-2 text-white font-bold">Send to Mail</button>
          </form>
              
        </div>
      </div>
    </div>

    
    <label class="rounded-full bg-blue-500 text-white font-semibold px-4 py-2 fixed bottom-5 sm:bottom-auto sm:top-5 right-5 cursor-pointer hover:shadow-2xl transform duration-700" @click="showEmailModal = true">Send to email</label>
  </div>

  <script>
    const configDoughnut = {
      type: "doughnut",
      data: {
        labels: ["Biology", "Chemistry", "Physics"],
        datasets: [{
          backgroundColor: [ "Green", "Yellow", "Red" ],
          data: [{{ $valuesForChart['bioValue'] }}, {{ $valuesForChart['chemValue'] }}, {{ $valuesForChart['phyValue'] }}],
          hoverOffset: 20,
        }],
      },
      options: {
        plugins: {
          legend: {
            labels: { color: 'black' }
          }
        }
      },
    };

    var chartBar = new Chart(
      document.getElementById("chartDoughnut"),
      configDoughnut
    );
  </script>
</x-app-layout>