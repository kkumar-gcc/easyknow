<div class="container-fluid  about">
    <div class="e-card">
        <div class="card-body">
            <h4 class="title">About</h4>
            <hr>
            <div class="row">
                <div class="col-md-7">
                    <div class="sub-body">
                        <h5 class="sub-title sub-title-color">Description</h5>
                        <p> {{ $user->description }}</p>
                    </div>
                    <div class="sub-body">
                        <h5 class="sub-title sub-title-color">Skills</h5>
                        <p> {{ $user->description }}</p>
                    </div>
                   
                </div>
                <div class="col-md-5">
                    <div class="alert alert-info" role="alert" data-mdb-color="info">
                        <div class="sub-body">
                            <h5 class="sub-title ">Location</h5>
                            <hr>
                            <ul class="sidebar-nav" style="padding-left:10px;">
                                <li class="sidebar-item">
                                    <p class="sidebar-link sidebar-change alert-link">
                                        <span class="icon-primary">{{ svg('bi-facebook') }}
                                        </span>
                                        facebook  </p>
                                </li>
                                <li class="sidebar-item">
                                    <p class="sidebar-link sidebar-change alert-link">
                                        <span class="icon-primary">{{ svg('bi-facebook') }}
                                        </span>
                                        facebook  </p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="alert alert-warning" role="alert" data-mdb-color="info">
                        <div class="sub-body">
                            <h5 class="sub-title ">Connect</h5>
                            <hr>
                            <ul class="sidebar-nav" style="padding-left:10px;">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link sidebar-change link alert-link">
                                        <span class="icon-primary">{{ svg('bi-facebook') }}
                                        </span>
                                        facebook  </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/blogs" class="sidebar-link sidebar-change link alert-link">  <span class="icon-primary">{{ svg('entypo-github') }}
                                    </span> Github</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link sidebar-change link alert-link">
                                        <span class="icon-primary">{{ svg('feathericon-instagram') }}</span> Instagram
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
