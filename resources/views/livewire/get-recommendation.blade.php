<div>

  <form class="grid grid-rows-1 gap-4 max-w-xs bg-gray-100 p-8" method="POST" action="get-result">
    @csrf

    <div class="text-gray-500 relative focus-within:text-gray-700">
      <div class="absolute left-2 top-1.5 text-xl text-gray-700">
        <i class="far fa-user"></i>
      </div>
      <input type="text" class="bg-gray-100 focus:outline-none pl-10 pr-2 py-2 w-full placeholder-gray-700" placeholder="Student Code" wire:model.debounce.300ms="studentCode" name="studentCode" required>

      <div class="text-xs h-1 {{ ($resultExists === false) ? 'text-red-600' : 'text-green-500' }}">
        @if($resultExists === false)
          Code does not exist
        @elseif($resultExists === true)
          Code is valid. Submit the form!
        @endif
      </div>
    </div>

    <button class="bg-blue-600 duration-300 w-full py-2 my-2 text-white font-bold">Get Result</button>
  </form>
</div>
