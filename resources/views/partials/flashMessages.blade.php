@if ( session('success'))
<div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
    <div class="row w-100">
        <div class="text-center col-1 align-items-center d-flex justify-content-center">
            <div class="w-100">
                <i class="fas fa-info-circle" style="color: #00ffc8; font-size: 22px"></i>
            </div>
        </div>
        <div class="col-11">
            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #15da98">Instrucciones</p>
            <p class="m-0" style="font-size: 14px; color:#15da98 ">{{session ('success')}}</p>

        </div>
    </div>
</div>

@endif


@if ( session('error'))
<div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
    <div class="row w-100">
        <div class="text-center col-1 align-items-center d-flex justify-content-center">
            <div class="w-100">
                <i class="fas fa-info-circle" style="color: #ffb055; font-size: 22px"></i>
            </div>
        </div>
        <div class="col-11">
            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #ff3c00">Instrucciones</p>
            <p class="m-0" style="font-size: 14px; color:#ff3c00 ">{{session ('error')}}</p>

        </div>
    </div>
</div>

@endif
