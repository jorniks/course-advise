<div>


  <label class="rounded-full bg-blue-500 text-white font-semibold px-4 py-2 fixed bottom-5 sm:bottom-auto sm:top-5 right-5 cursor-pointer hover:shadow-2xl transform duration-700" @click="$wire.showEmailModal = true">Send to email</label>


  <div class="modal fixed left-0 top-0 px-3 w-full h-full justify-center items-center overflow-auto z-30 bg-gray-900 bg-opacity-20" x-transition x-bind:class="($wire.showEmailModal) ? 'flex' : 'hidden'">
    <div class="modal-container bg-white w-full md:max-w-sm mx-auto shadow-lg z-10 overflow-y-auto">
      <div class="modal-content py-4 text-left px-2 md:px-5 bg-blue-900 bg-opacity-10">
        <!--Title-->
        <div class="flex justify-end items-center pb-8">
          <div class="modal-close cursor-pointer z-10" @click="$wire.showEmailModal = false">
            <i class="fas fa-times-circle text-xl hover:text-red-600 duration-300"></i>
          </div>
        </div>

        <!--Body-->
        <form class="grid grid-rows-1 gap-4" method="POST" wire:submit.prevent="sendMail">
          @csrf

          <div class="text-gray-500 relative focus-within:text-gray-700">
            <div class="absolute left-2 top-1.5 text-xl text-gray-700">
              <i class="far fa-user"></i>
            </div>
            <input type="text" class="focus:bg-white focus:ring-1 focus:ring-black pl-10 pr-2 py-2 w-full placeholder-gray-700" placeholder="First Name" x-model="studentName" wire:model="studentName" required>
          </div>

          <div class="text-gray-500 relative focus-within:text-gray-700">
            <div class="absolute left-2 top-1.5 text-xl text-gray-700">
              <i class="far fa-envelope"></i>
            </div>
            <input type="text" class="focus:bg-white focus:ring-1 focus:ring-black pl-10 pr-2 py-2 w-full placeholder-gray-700" placeholder="Your Email" wire:model="studentEmail" required>
          </div>

          <button class="bg-green-500 hover:bg-green-600 duration-300 w-full py-2 my-2 text-white font-bold">{{ $buttonText }}</button>
        </form>
            
      </div>
    </div>
  </div>
</div>
