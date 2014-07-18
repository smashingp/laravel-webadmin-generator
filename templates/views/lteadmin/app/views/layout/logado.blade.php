<!DOCTYPE html>
<html>
    <head>
        @include("layout.head")
    </head>
    <body class="skin-blue fixed">
        <!-- header logo: style can be found in header.less -->
	@include("layout.header")
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            @include("layout.asidemenu")

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
		@include("layout.breadcrumb")

                <!-- Main content -->
                <section class="content">

                        @yield("conteudo")

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
        @include("layout.js")
        
        @yield("script")
        
    </body>
</html>