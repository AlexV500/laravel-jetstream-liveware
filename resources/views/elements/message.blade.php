@if(session()->has('message'))
    <div class="px-5 py-4 mb-4 border-green-500 bg-green-400">
        <h3 class="text-white">{{session('message')}}</h3>
    </div>
@endif
