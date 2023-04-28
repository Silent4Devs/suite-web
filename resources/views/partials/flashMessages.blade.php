@if (session('success'))
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                    style="background:#8eedcd!important; border-top:solid 3px #38daa4; color:#0d996a">
                    <strong style="color:#0f875f"><i class="mr-1 far fa-thumbs-up"></i> Buen Trabajo,</strong>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

@endif

@if (session('error'))
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert"
                    style="background:#ffad54!important; border-top:solid 3px #ff8400!important; color:#d87000">
                    <strong style="color:#e98213"><i class="mr-1 far fa-thumbs-down"></i> Opps...</strong>
                    {{ session('error') }} <button type="button" class="close" data-dismiss="alert"
                        aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('deleted'))

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class=" alert alert-danger alert-dismissible fade show" role="alert"
                    style="background:#8eedcd!important; border-top:solid 3px #38daa4; color:#0d996a">
                    <strong style="color:#0f875f"><i class="mr-1 far fa-thumbs-up"></i> Bien hecho,</strong>
                    {{ session('deleted') }} <button type="button" class="close" data-dismiss="alert"
                        aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
            </div>
        </div>
    </div>

@endif
