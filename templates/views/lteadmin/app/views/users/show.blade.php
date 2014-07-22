@extends("layout/logado")
@section("conteudo")
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">{{ ($user->status==-1?"<span class=\"label label-danger\">suspenso</span>":($user->status==0?"<span class=\"label label-warning\">inativo</span>":"<span class=\"label label-success\">ativo</span>")) }}<strong style="margin-left: 10px;margin-right:10px;">{{ $user->name }}</strong></h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form role="form">
        <div class="box-body">
            <img src="{{ $user->photofullpath }}" style="width:70px; border: 1px solid black;" class="pull-left">
            <div style="margin-left: 80px">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <h4><strong>Email :</strong> {{ $user->email }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-10" style="margin-left:-80px">
                        <h4><strong>Criado em :</strong> {{ $user->created_at->diffForHumans() }}</h4>
                    </div>
                </div>                
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer clearfix">
            <a href="{{ route("users.index") }}" class="btn btn-primary pull-left"><i class="fa fa-arrow-circle-left"></i> Voltar</a>
            <a href="{{ route("users.status", $user->id) }}" class="btn btn-danger pull-right"> {{ ($user->status < 0?"<i class=\"fa fa-undo\"></i> Reativar":"<i class=\"fa fa-trash-o\"></i> Suspender") }}</a>
        </div>
    </form>
</div><!-- /.box -->
@stop