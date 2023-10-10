<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A stepper plugin for Bootstrap 4.">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="bs-stepper/dist/css/bs-stepper.min.css">
    <title>Bootstrap stepper</title>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

<div class="container flex-grow-1 flex-shrink-0 py-5">
    <div class="mb-5 p-4 bg-white shadow-sm">
        <h3>Linear stepper</h3>
        <div id="stepper1" class="bs-stepper">
            <div class="bs-stepper-header" role="tablist">
                <div class="step" data-target="#test-l-1">
                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Email</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-l-2">
                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Password</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-l-3">
                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Validate</span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <form onSubmit="return false">
                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                    </div>
                    <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                        <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                    </div>
                    <div id="test-l-3" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="stepper1trigger3">
                        <button class="btn btn-primary mt-5" onclick="stepper1.previous()">Previous</button>
                        <button type="submit" class="btn btn-primary mt-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="mb-5 p-4 bg-white shadow-sm">
        <div id="stepper2" class="bs-stepper">
            <div class="bs-stepper-header" role="tablist">
                <div class="step" data-target="#test-nl-1">
                    <button type="button" class="step-trigger" role="tab" id="stepper2trigger1" aria-controls="test-nl-1">
                <span class="bs-stepper-circle">
                  <span class="fas fa-user" aria-hidden="true"></span>
                </span>
                        <span class="bs-stepper-label">Name</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-nl-2">
                    <button type="button" class="step-trigger" role="tab" id="stepper2trigger2" aria-controls="test-nl-2">
                <span class="bs-stepper-circle">
                  <span class="fas fa-map-marked" aria-hidden="true"></span>
                </span>
                        <span class="bs-stepper-label">Address</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-nl-3">
                    <button type="button" class="step-trigger" role="tab" id="stepper2trigger3" aria-controls="test-nl-3">
                <span class="bs-stepper-circle">
                  <span class="fas fa-save" aria-hidden="true"></span>
                </span>
                        <span class="bs-stepper-label">Submit</span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <form onSubmit="return false">
                    <div id="test-nl-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper2trigger1">
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="email" class="form-control" id="exampleInputName1" placeholder="Enter your name">
                        </div>
                        <button class="btn btn-primary" onclick="stepper2.next()">Next</button>
                    </div>
                    <div id="test-nl-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper2trigger2">
                        <div class="form-group">
                            <label for="exampleInpuAddress1">Address</label>
                            <input type="email" class="form-control" id="exampleInpuAddress1" placeholder="Enter your address">
                        </div>
                        <button class="btn btn-primary" onclick="stepper2.next()">Next</button>
                    </div>
                    <div id="test-nl-3" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="stepper2trigger3">
                        <button type="submit" class="btn btn-primary mt-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="mb-5 p-4 bg-white shadow-sm">
        <h3>Non linear stepper (with fade)</h3>
        <div id="stepper3" class="bs-stepper">
            <div class="bs-stepper-header" role="tablist">
                <div class="step" data-target="#test-nlf-1">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger1" aria-controls="test-nlf-1">
                <span class="bs-stepper-circle">
                  <span class="fas fa-user" aria-hidden="true"></span>
                </span>
                        <span class="bs-stepper-label">Name</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-nlf-2">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger2" aria-controls="test-nlf-2">
                <span class="bs-stepper-circle">
                  <span class="fas fa-map-marked" aria-hidden="true"></span>
                </span>
                        <span class="bs-stepper-label">Address</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-nlf-3">
                    <button type="button" class="step-trigger" role="tab" id="stepper3trigger3" aria-controls="test-nlf-3">
                <span class="bs-stepper-circle">
                  <span class="fas fa-save" aria-hidden="true"></span>
                </span>
                        <span class="bs-stepper-label">Submit</span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <form onSubmit="return false">
                    <div id="test-nlf-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger1">
                        <div class="form-group">
                            <label for="exampleInputName2">Name</label>
                            <input type="email" class="form-control" id="exampleInputName2" placeholder="Enter your name">
                        </div>
                        <button class="btn btn-primary" onclick="stepper3.next()">Next</button>
                    </div>
                    <div id="test-nlf-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper3trigger2">
                        <div class="form-group">
                            <label for="exampleInpuAddress2">Address</label>
                            <input type="email" class="form-control" id="exampleInpuAddress2" placeholder="Enter your address">
                        </div>
                        <button class="btn btn-primary" onclick="stepper3.next()">Next</button>
                    </div>
                    <div id="test-nlf-3" role="tabpanel" class="bs-stepper-pane fade text-center" aria-labelledby="stepper3trigger3">
                        <button type="submit" class="btn btn-primary mt-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="mb-5 p-4 bg-white shadow-sm">
        <h3>Vertical linear stepper</h3>
        <div id="stepper4" class="bs-stepper vertical">
            <div class="bs-stepper-header" role="tablist">
                <div class="step" data-target="#test-vl-1">
                    <button type="button" class="step-trigger" role="tab" id="stepper4trigger1" aria-controls="test-vl-1">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Email</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-vl-2">
                    <button type="button" class="step-trigger" role="tab" id="stepper4trigger2" aria-controls="test-vl-2">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Password</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-vl-3">
                    <button type="button" class="step-trigger" role="tab" id="stepper4trigger3" aria-controls="test-vl-3">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Validate</span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <form onSubmit="return false">
                    <div id="test-vl-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper4trigger1">
                        <div class="form-group">
                            <label for="exampleInputEmailV1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmailV1" placeholder="Enter email">
                        </div>
                        <button class="btn btn-primary" onclick="stepper4.next()">Next</button>
                    </div>
                    <div id="test-vl-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper4trigger2">
                        <div class="form-group">
                            <label for="exampleInputPasswordV1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPasswordV1" placeholder="Password">
                        </div>
                        <button class="btn btn-primary" onclick="stepper4.previous()">Previous</button>
                        <button class="btn btn-primary" onclick="stepper4.next()">Next</button>
                    </div>
                    <div id="test-vl-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper4trigger3">
                        <button class="btn btn-primary mt-5" onclick="stepper4.previous()">Previous</button>
                        <button type="submit" class="btn btn-primary mt-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="mb-5 p-4 bg-white shadow-sm">
        <h3>Form validation</h3>
        <div id="stepperForm" class="bs-stepper">
            <div class="bs-stepper-header" role="tablist">
                <div class="step" data-target="#test-form-1">
                    <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger1" aria-controls="test-form-1">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Email</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-form-2">
                    <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger2" aria-controls="test-form-2">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Password</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-form-3">
                    <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger3" aria-controls="test-form-3">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Validate</span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <form class="needs-validation" onSubmit="return false" novalidate>
                    <div id="test-form-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepperFormTrigger1">
                        <div class="form-group">
                            <label for="inputMailForm">Email address <span class="text-danger font-weight-bold">*</span></label>
                            <input id="inputMailForm" type="email" class="form-control" placeholder="Enter email" required>
                            <div class="invalid-feedback">Please fill the email field</div>
                        </div>
                        <button class="btn btn-primary btn-next-form">Next</button>
                    </div>
                    <div id="test-form-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepperFormTrigger2">
                        <div class="form-group">
                            <label for="inputPasswordForm">Password <span class="text-danger font-weight-bold">*</span></label>
                            <input id="inputPasswordForm" type="password" class="form-control" placeholder="Password" required>
                            <div class="invalid-feedback">Please fill the password field</div>
                        </div>
                        <button class="btn btn-primary btn-next-form">Next</button>
                    </div>
                    <div id="test-form-3" role="tabpanel" class="bs-stepper-pane fade text-center" aria-labelledby="stepperFormTrigger3">
                        <button type="submit" class="btn btn-primary mt-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="bs-stepper/dist/js/bs-stepper.min.js"></script>
<script src="bs-stepper/js/main.js"></script>
</body>
</html>
