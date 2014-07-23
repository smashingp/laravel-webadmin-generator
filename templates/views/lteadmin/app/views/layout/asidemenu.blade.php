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
                        <li class="treeview {{ ($activemenu == 2?'active':"") }}">
                            <a href="#">
                                <i class="fa fa-users"></i> <span>Usuários</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{ route("users.index") }}"><i class="fa fa-angle-double-right"></i> Listagem</a></li>
                                <li><a href="{{ route("users.create") }}"><i class="fa fa-angle-double-right"></i> Cadastro</a></li>
                            </ul>                            
                        </li>                            
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>