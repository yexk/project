@extends('back.layouts.default')

@section('title')
文章列表
@stop

@section('links')
<!-- <link href="assets/datatables/css/jquery.dataTables.min.css" rel="stylesheet"><!-- ADVANCED DATATABLE CSS -->
<link href="assets/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet"><!-- ADVANCED DATATABLE CSS -->

@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
     <section class="panel">
        <header class="panel-heading">
           <span class="label label-primary">文章列表</span>
           <span class="tools pull-right">
           <a href="javascript:;" class="fa fa-chevron-down"></a>
           <a href="javascript:;" class="fa fa-times"></a>
           </span>
        </header>
        <div class="panel-body">
           <div class="adv-table">
              <table class="display table table-bordered table-striped" id="show_art_lists">
                 <thead>
                    <tr>
                       <th>ID</th>
                       <th>分类名称</th>
                       <th>标题</th>
                       <th>作者</th>
                       <th>状态</th>
                       <th>发布时间</th>
                       <th>创建时间</th>
                       <th>更新时间</th>
                       <th>操作</th>
                    </tr>
                 </thead>
              </table>
           </div>
        </div>
     </section>
  </div>
</div>
@stop

@section('others')
<!-- Modal -->
<div class="modal fade" id="cate_delelte" tabindex="-1" role="dialog" aria-labelledby="myDelModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myDelModalLabel">提示</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-2" style="display: none;">
           <div class="switch" id="_force" data-on-label="是" data-off-label="否">
             <input type="checkbox" data-toggle="switch" >
           </div>
          </div>
          <div class="col-lg-10">
            <div id="div_confirm_msg" class="div_confirm_msg" ></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button id="btn_cate_delete" type="button" class="btn btn-primary">确定删除</button>
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')
<script src="assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/datatables/js/dataTables.bootstrap.min.js"></script>
<script >
$(function() {
  $('#show_art_lists').DataTable({
    serverSide: true,//分页，取数据等等的都放到服务端去  http://www.cnblogs.com/sheldon-lou/p/4179002.html
    processing: true,//载入数据的时候是否显示“载入中”
    pageLength: 10,//首次加载的数据条数
    // ordering: false,//排序操作在服务端进行，所以可以关了。
    ajax: {//类似jquery的ajax参数，基本都可以用。
      type: "get",//后台指定了方式，默认get，外加datatable默认构造的参数很长，有可能超过get的最大长度。
      url: "{{ route('art.lists') }}",
      // dataSrc: "data",//默认data，也可以写其他的，格式化table的时候取里面的数据
      /*data: function (d) {//d 是原始的发送给服务器的数据，默认很长。
          var param = {};//因为服务端排序，可以新建一个参数对象
          param.start = d.start;//开始的序号
          param.length = d.length;//要取的数据的
          var formData = $("#filter_form").serializeArray();//把form里面的数据序列化成数组
          formData.forEach(function (e) {
              param[e.name] = e.value;
          });
          return param;//自定义需要传递的参数。
      },*/
    },
    columns: [
        { data: "id", },
        { data: "cate_id", },
        { data: "title", },
        { data: "user_id", },
        { data: "status", },
        { data: "public_at", },
        { data: "created_at", },
        { data: "updated_at", },
        { data: "id",},
        
    ],
    language: {
      lengthMenu: '<select class="form-control input-xsmall">' + '<option value="5">5</option>' + '<option value="10">10</option>' + '<option value="20">20</option>' + '<option value="30">30</option>' + '<option value="40">40</option>' + '<option value="50">50</option>' + '</select>条记录',//左上角的分页大小显示。
        processing: "正在加载中...",//处理页面数据的时候的显示
        paginate: {//分页的样式文本内容。
           previous: "上一页",
           next: "下一页",
           first: "第一页",
           last: "最后一页"
        },
        zeroRecords: "没有内容",//table tbody内容为空时，tbody的内容。
        //下面三者构成了总体的左下角的内容。
        info: "总共_PAGES_ 页，显示第_START_ 到第 _END_ ，筛选之后得到 _TOTAL_ 条，初始_MAX_ 条 ",//左下角的信息显示，大写的词为关键字。
        infoEmpty: "0条记录",//筛选为空时左下角的显示。
        infoFiltered: ""//筛选之后的左下角筛选提示(另一个是分页信息显示，在上面的info中已经设置，所以可以不显示)，
    }
  });
});
</script>

@stop
