    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar start-->
            <div class="side-menu-fixed">
                <div class="scrollbar side-menu-bg">
                    <ul class="nav navbar-nav side-menu" id="sidebarnav">
                        <!-- menu item Dashboard-->
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                                <div class="pull-left"><i class="ti-home"></i><span {{-- class="right-nav-text">{{ __('main_trans.Dashboard_page') }}</span> --}}
                                        class="right-nav-text">{{ __('Dashboard') }}</span>
                                </div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="index.html">Dashboard 01</a> </li>
                                <li> <a href="index-02.html">Dashboard 02</a> </li>
                            </ul>
                        </li>
                        <!-- menu title -->
                        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                        <!-- menu item Elements-->
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                                <div class="pull-left"><i class="ti-palette"></i><span {{-- class="right-nav-text">{{ __('main_trans.Grades') }}</span></div> --}}
                                        class="right-nav-text">{{ __('Governorates') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="elements" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('governorates.index') }}">{{ __('Governorates List') }}</a>
                                </li>
                            </ul>
                        </li>

                        <!-- menu item -->
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements1">
                                <div class="pull-left"><i class="ti-palette"></i><span {{-- class="right-nav-text">{{ __('main_trans.Grades') }}</span></div> --}}
                                        class="right-nav-text">{{ __('Cities') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="elements1" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('cities.index') }}">{{ __('Cities List') }}</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements2">
                                <div class="pull-left"><i class="ti-palette"></i><span {{-- class="right-nav-text">{{ __('main_trans.Grades') }}</span></div> --}}
                                        class="right-nav-text">{{ __('Posts') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="elements2" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('posts.index') }}">{{ __('Posts List') }}</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements3">
                                <div class="pull-left"><i class="ti-palette"></i><span {{-- class="right-nav-text">{{ __('main_trans.Grades') }}</span></div> --}}
                                        class="right-nav-text">{{ __('Categories') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="elements3" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('categories.index') }}">{{ __('Categories List') }}</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements4">
                                <div class="pull-left"><i class="ti-palette"></i><span {{-- class="right-nav-text">{{ __('main_trans.Grades') }}</span></div> --}}
                                        class="right-nav-text">{{ __('Clients') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="elements4" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('clients.index') }}">{{ __('Clients List') }}</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- Left Sidebar End-->

            <!--=================================