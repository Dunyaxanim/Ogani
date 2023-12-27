<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @auth
                    <li class="nav-item mr-4">
                        <a href="{{ route('profil') }}" class="nav-link">
                            <i class="fa-solid fa-user"></i>
                            <p>{{ Auth::user()->name }}</p>
                        </a>
                    </li>
                @endauth


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            {{ __('Settings') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                            <a href="{{ route('admin.general-index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{ __('General') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('admin.social-media-index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{ __('Social Media') }}
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.menu-index') }}" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>{{ __('Menu') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.blog-index') }}" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>{{ __('Blogs') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.news-index') }}" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>{{ __('News') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.category-index') }}" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>{{ __('Category') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.product-index') }}" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>{{ __('Product') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.hero-index') }}" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>{{ __('Hero') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user-index') }}" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>{{ __('Users') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.map-index') }}" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>{{ __('Map') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.measurement-index') }}" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>{{ __('Measurement') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.mailbox') }}" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>{{ __('Mailbox') }}</p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('admin.order-index') }}" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>{{ __('Orders') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
