@extends('layouts.admin')
@section('content')




<div class="card mt-5">
  <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
      <h3 class="mb-2  text-center text-white"><strong>Implementación de ISO 27001</strong></h3>
  </div>

    <div class="card-body">
    <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills nav-fill" id="myTabJust" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#home-just" role="tab"
                           aria-controls="home-just"
                           aria-selected="true">Introducción</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab-just" data-toggle="tab" href="#profile-just" role="tab"
                           aria-controls="profile-just"
                           aria-selected="false">Guía
                            de Implementación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab-just" data-toggle="tab" href="#contact-just" role="tab"
                           aria-controls="contact-just"
                           aria-selected="false">Plan
                            de Trabajo Base</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab-just" data-toggle="tab" href="#just" role="tab"
                           aria-controls="contact-just"
                           aria-selected="false">Consultoría
                            en línea</a>
                    </li>
                </ul>

                <div class="tab-content card pt-5" id="myTabContentJust">
                    <div class="tab-pane fade show active" id="home-just" role="tabpanel"
                         aria-labelledby="home-tab-just">
                        <!-- Introduccion>-->
                        @include('admin.implementacions.introduccion')
                    <!-- Introduccion -->
                    </div>



                    <div class="tab-pane fade" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-just">
                      <!--Guia de introducción-->


                        @include('admin.implementacions.guia')


                    </div>



                    <div class="tab-pane fade" id="contact-just" role="tabpanel" aria-labelledby="contact-tab-just">
                        <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic
                            lomo retro
                            fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft
                            beer, iphone
                            skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                            Leggings
                            gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles
                            pitchfork
                            biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of
                            them, vinyl
                            craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                    </div>
                    <div class="tab-pane fade" id="just" role="tabpanel" aria-labelledby="contact-tab-just">
                        <p>asd</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
