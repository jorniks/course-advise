<x-app-layout>
  <div class="relative min-h-screen bg-gray-100" x-data="{ unit: {{ $gradeScoreValues['unitScore'] }}, course: '{{ $gradeScoreValues['course'] }}', showEmailModal: false, studentName: '' }">
    <div class="sm:grid grid-cols-10 h-screen">
      <section class="sm:col-span-3 px-6 pt-14 sm:p-6 flex flex-col justify-center">
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
        <div class="py-3 text-red-500">
          Use <span class="font-black">{{ $uniqueID }}</span> to check this recommendation next time.
        </div>
      </section>

      <section class="sm:col-span-7 p-4 sm:px-24 bg-gray-200 flex items-center">
        <div class="">
          Hello <span x-text="studentName"></span>,
          <p class="py-3">
            After analyzing your performance over the course of four (4) semesters, it is observed that you perform better in courses related to {{ $gradeScoreValues['course'] }}. Based on your Average point {{ $gradeScoreValues['suggestion1'] }} or {{ $gradeScoreValues['suggestion2'] }} is the best option for your HND program.
          </p>
          <p class="">
            With an average score of {{ $gradeScoreValues['unitScore'] }} units in {{ $gradeScoreValues['course'] }}, diligently consider the recommended courses above and go for one that best suits your inner drive.
          </p>
          <p class="py-3 sm:text-right font-bold uppercase">
            Best Wishes
          </p>
        </div>
      </section>
    </div>

    <livewire:send-mail :gradeScoreValues="$gradeScoreValues" />

    
  </div>

  <script>
    const configDoughnut = {
      type: "doughnut",
      data: {
        labels: ["{{ $gradeScoreValues['course'] }}", "{{ $gradeScoreValues['courseSuggestion1']['course'] }}", "{{ $gradeScoreValues['courseSuggestion2']['course'] }}"],
        datasets: [{
          backgroundColor: [ "Green", "Yellow", "Red" ],
          data: [{{ $gradeScoreValues['unitScore'] }}, {{ $gradeScoreValues['courseSuggestion1']['unitScore'] }}, {{ $gradeScoreValues['courseSuggestion2']['unitScore'] }}],
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