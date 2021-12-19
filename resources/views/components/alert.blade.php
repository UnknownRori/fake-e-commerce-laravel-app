@if (Session::has('success'))
    <div id="msg" class="bg-success text-center text-white p-1 m-0">
        <span> {{ Session::get('success') }} </span>
    </div>
@elseif (Session::has('fail'))
    <div id="msg" class="bg-danger text-center text-white p-1 m-0">
        <span> {{ Session::get('fail') }} </span>
    </div>
@endif
