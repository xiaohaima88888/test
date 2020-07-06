@extends("admin.layout.main")

@section("content")
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">登录日志列表</h3>
                    </div>
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">id</th>
                                <th>用户ID</th>
                                <th>访问路径</th>
                                <th>访问方式</th>
                                <th>IP</th>
                                <th>时间</th>
                            </tr>
                            @foreach($notices as $notice)
                                <tr>
                                    <td>{{$notice->id}}</td>
                                
                                    <td>{{$notice->uid}}</td>
                                    <td>{{$notice->path}}</td>
                                    <td>{{$notice->method}}</td>
                                    <td>{{$notice->ip}}</td>
                                    <td>{{$notice->updated_at}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection