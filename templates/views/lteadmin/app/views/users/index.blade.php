@extends("layout/logado")
@section("conteudo")
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Usuários</h3>
                <div class="box-tools">
                    {{ Form::open(array("route"=>"users.index","class"=>"text-right","method"=>"get")) }}
                        <div class="input-group">
                            <input type="text" value="{{ $busca }}" name="q" class="form-control input-sm pull-right" style="width: 150px;" placeholder="busca"/>
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>                        
                        </div>
                    {{ Form::close() }}
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>email</th>
                        <th>Data Cadastro</th>
                        <th>Status</th>
                    </tr>
@foreach ($users as $user)                    
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ action('UsersController@show', $user->id) }}">{{ $user->name }}</a></td>
                        <td><a href="{{ action('UsersController@show', $user->id) }}">{{ $user->email }}</a></td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ ($user->status==-1?"<span class=\"label label-danger\">suspenso</span>":($user->status==0?"<span class=\"label label-warning\">inativo</span>":"<span class=\"label label-success\">ativo</span>")) }}</td>
                    </tr>
@endforeach
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
<!--                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>-->
                {{ $users->links() }}
            </div>            
        </div><!-- /.box -->
    </div>
</div>
@stop

@section("script")
<script>
    $(function() {
        $('.pagination').addClass('pagination-sm no-margin pull-right');
    });
</script>
@stop