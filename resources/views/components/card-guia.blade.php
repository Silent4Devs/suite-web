<div class="px-1 py-2 mb-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
    <div class="row w-100">
        <div class="text-center col-1 align-items-center d-flex justify-content-center">
            <div class="w-100">
                <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
            </div>
        </div>
        <div class="col-11">
            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                {{ $title }}</p>
            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">
                {!! $message !!}
                <br>
                <small class="text-muted">{!! $html ?? '' !!}</small>
            </p>
        </div>
    </div>
</div>
