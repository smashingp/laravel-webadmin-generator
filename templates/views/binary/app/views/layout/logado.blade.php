<!DOCTYPE html>
<html>

<head>
	@include("layout.head")
</head>

<body>

    <div id="wrapper">

        @include("layout.nav")

        <div id="page-wrapper">
	    @include("layout.header")
            <!-- /.row -->
            @yield("conteudo")
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	@include("layout.js")
	
	@yield("script")
	
</body>

</html>
