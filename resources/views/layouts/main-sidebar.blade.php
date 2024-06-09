    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar start-->
            <div class="side-menu-fixed">
                <div class="scrollbar side-menu-bg">
                    <ul class="nav navbar-nav side-menu" id="sidebarnav">
                        <!-- menu item Dashboard-->
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                                <div class="pull-left"><i class="text-info ti-home"></i><span {{-- class="right-nav-text">{{ __('main_trans.Dashboard_page') }}</span> --}}
                                        class="right-nav-text">{{ __('Dashboard') }}</span>
                                </div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="index.html">Dashboard 01</a> </li>
                            </ul>
                        </li>
                        <!-- menu title -->
                        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                        <!-- menu item Elements-->
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                                <div class="pull-left"><i class="text-info ti-location-arrow"></i><span
                                        {{-- class="right-nav-text">{{ __('main_trans.Grades') }}</span></div> --}} class="right-nav-text">{{ __('Governorates') }}</span>
                                </div>
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
                                <div class="pull-left"><i class="text-info ti-location-pin"></i><span
                                        {{-- class="right-nav-text">{{ __('main_trans.Grades') }}</span></div> --}} class="right-nav-text">{{ __('Cities') }}</span></div>
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
                                <div class="pull-left"><i class="text-info ti-layout-menu-v"></i><span
                                        {{-- class="right-nav-text">{{ __('main_trans.Grades') }}</span></div> --}} class="right-nav-text">{{ __('Posts') }}</span></div>
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
                                <div class="pull-left"><i class="text-info ti-layers"></i><span {{-- class="right-nav-text">{{ __('main_trans.Grades') }}</span></div> --}}
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
                                <div class="pull-left"><i class="text-info ti-user"></i><span {{-- class="right-nav-text">{{ __('main_trans.Grades') }}</span></div> --}}
                                        class="right-nav-text">{{ __('Clients') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="elements4" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('clients.index') }}">{{ __('Clients List') }}</a>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements5">
                                <div class="pull-left"><i class="text-info ti-comments"></i><span
                                        class="right-nav-text">{{ __('Contacts') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="elements5" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('contacts.index') }}">{{ __('Contacts List') }}</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements6">
                                <div class="pull-left"><i class="text-info ti-pin"></i><span
                                        class="right-nav-text">{{ __('Donations') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="elements6" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('donations.index') }}">{{ __('Donations List') }}</a>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements7">
<<<<<<< HEAD
                                <div class="pull-left"><i class="text-info ti-id-badge"></i><span
                                        class="right-nav-text">{{ __('Users') }}</span>
                                </div>
=======
                                <div class="pull-left"><i class="ti-palette"></i><span
                                        class="right-nav-text">{{ __('Admins') }}</span></div>
>>>>>>> e6235a202f6f7643cce5012104e3f351bcb17c1b
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>

                            <ul id="elements7" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('users.index') }}">{{ __('Settings List') }}</a>
                                </li>
                            </ul>

                        </li>


                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements7">
                                <div class="pull-left"><i class="text-info ti-settings"></i><span
                                        class="right-nav-text">{{ __('Settings') }}</span>
                                </div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>

                            <ul id="elements7" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('admins.index') }}">{{ __('Admins List') }}</a>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements8">
                                <div class="pull-left"><i class="ti-palette"></i><span
                                        class="right-nav-text">{{ __('Settings') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="elements8" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('admin.settings.edit') }}">{{ __('Settings List') }}</a>
                                </li>
                            </ul>

                        </li>

                    </ul>
                </div>
            </div>

            <!-- Left Sidebar End-->

            <!--=================================
