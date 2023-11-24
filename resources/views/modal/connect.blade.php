<div class="modal fade" id="modal-connect" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="card modal-content mx-3">
            <div class="row g-0">
                <div class="col-md-6 bg-gradient-primary rounded-start d-md-block d-none">
                    <img src="/assets/img/illustrations/intro-satoshifiesta-connect-min.png" class="img-fluid" alt="..."/>
                </div>
                <div class="col-md-6">
                    <div class="modal-header border-0">
                        <ul class="nav nav-pills border-0" id="auth-tabs" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link py-1 active" data-bs-toggle="pill" data-bs-target="#login" role="tab" aria-selected="true">Login</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link py-1" data-bs-toggle="pill" data-bs-target="#register" role="tab" aria-selected="false">Register</button>
                            </li>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times text-body"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="login" role="tabpanel">
                                @include('form.login')
                            </div>
                            <div class="tab-pane fade show" id="register" role="tabpanel">
                                @include('form.register')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>