            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ $userauth->photofullpath }}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Olá, {{ $userauth->name }}</p>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li {{ ($activemenu == 1?'class="active"':"") }}>
                            <a href="/dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li {{ ($activemenu == 2?'class="active"':"") }}>
                            <a href="/users">
                                <i class="fa fa-users"></i> <span>Usuários</span>
                            </a>
                        </li>                            
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>