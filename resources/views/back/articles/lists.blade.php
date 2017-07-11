@extends('back.layouts.default')

@section('title')
文章列表
@stop

@section('links')
<link href="assets/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet"><!-- ADVANCED DATATABLE CSS -->
<link rel="stylesheet" href="/common/css/editormd.preview.css" />

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

<!-- preview large modal -->
<div id="preview_modal" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="preview_modal_title"></h4>
      </div>
      <div class="modal-body" id="preview_modal_body" >
        <textarea name="preview_modal_content" id="preview_modal_content" style="display:none;"></textarea>
      </div>
    </div>
  </div>
</div>



@stop

@section('scripts')
<script src="assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/datatables/js/dataTables.bootstrap.min.js"></script>

<!-- markdown lib js -->
<script src="/common/js/lib/marked.min.js"></script>
<script src="/common/js/lib/prettify.min.js"></script>
<script src="/common/js/lib/raphael.min.js"></script>
<script src="/common/js/lib/underscore.min.js"></script>
<script src="/common/js/lib/sequence-diagram.min.js"></script>
<script src="/common/js/lib/flowchart.min.js"></script>
<script src="/common/js/lib/jquery.flowchart.min.js"></script>
<script src="/common/js/editormd.js"></script><!-- SWEETALERT JS -->
<script >
$(function() {
  $('#show_art_lists').DataTable({
    serverSide: true,//分页，取数据等等的都放到服务端去  http://www.cnblogs.com/sheldon-lou/p/4179002.html
    processing: true,//载入数据的时候是否显示“载入中”
    pageLength: 10, //默认加载的数据条数
    ordering: false,//排序操作在服务端进行，所以可以关了。
    ajax: {
      type: "get",
      url: "{{ route('art.lists') }}",
      // dataSrc: "data",//默认data，也可以写其他的，格式化table的时候取里面的数据
      data: function (d) {
        d.getAll = 1;
      },
    },
    columns: [
        { data: "id" , title:"ID" },
        { data: "cate_id", title:"分类名称" },
        { data: "title", title:"标题" },
        { data: "user_id", title:"作者" },
        { data: "status", title:"状态" , render:function(val) {
            if (1 == val) {
              return '<span class="label label-primary">发布中</span>';
            }else{
              return '<span class="label label-danger">已删除</span>';
            }
        } },
        { data: "label_id", title:"标签" , render:function(val) {
            if ( '' != val && -1 != val.indexOf(',')) {
              var label = val.split(',');
              var _html = '';
              for (var i = 0; i < label.length; i++) {
                _html += '<span class="badge bg-success">'+label[i]+'</span> ';
              }
              return _html;
            }else if ( '' != val ){
              return '<span class="badge bg-success">'+val+'</span> ';
            }else{
              return ' ';
            }
        } },
        { data: "public_at",  title:"发布时间" },
        { data: "created_at", title:"创建时间" },
        { data: "updated_at", title:"更新时间" },
        { data: "id", title:"操作" , render:function(val,dis,data){
            return '<button class="btn btn-sm btn-info" data-id="'+val+'" onclick="art_preview(this)">预览</button>&nbsp;<button class="btn btn-sm btn-primary" data-href="'+data['edited']+'" onclick="art_edited(this)">编辑</button>&nbsp;<button class="btn btn-sm btn-warning" data-title='+data['title']+' data-id="'+val+'" onclick="art_deleted(this)">删除</button>'
        } },
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
        search:'标题查找：',
        zeroRecords: "没有内容",//table tbody内容为空时，tbody的内容。
        //下面三者构成了总体的左下角的内容。
        info: "总共_PAGES_ 页，显示第_START_ 到第 _END_ ，筛选之后得到 _TOTAL_ 条，初始_MAX_ 条 ",//左下角的信息显示，大写的词为关键字。
        infoEmpty: "0条记录",//筛选为空时左下角的显示。
    }
  });
});

/**
 * 预览按钮的实现
 * @Author   Yexk       <yexk@carystudio.com>
 * @DateTime 2017-07-11
 * @param    {Object}   obj                   当前点击的对象
 * @return   {view}                           返回当前的预览情况
 */
function art_preview(obj) {
  $.ajax({
    url: '{{ route('art.lists') }}',
    type: 'get',
    dataType: 'json',
    data: {'id':$(obj).data('id'),'getOne':'1'},
    success:function(data){
      $('#preview_modal_title').html(data.title + '||' + data.public_at);
      $('#preview_modal_body').html('<textarea name="preview_modal_content" id="preview_modal_content" style="display:none;"></textarea>');
      $('#preview_modal_content').html(data.content);

      editormd.markdownToHTML("preview_modal_body", {
          htmlDecode      : "style,script,iframe",  // you can filter tags decode
          emoji           : true,
          taskList        : true,
          tex             : true,  // 默认不解析
          flowChart       : true,  // 默认不解析
          sequenceDiagram : true,  // 默认不解析
      });
      if ( '' != data.label_id && -1 != data.label_id.indexOf(',')) {
        var label = data.label_id.split(',');
        var _html = '';
        for (var i = 0; i < label.length; i++) {
          _html += '<a class="btn btn-info btn-sm" href="javascript:;" onclick="art_search('+label[i]+')" >'+label[i]+'</a>&nbsp;';
        }
        $('#preview_modal_body').prepend(_html);
      }else if ( '' != data.label_id ){
        $('#preview_modal_body').prepend('<a class="btn btn-info btn-sm" href="javascript:;" onclick="art_search('+data.label_id+')" >'+data.label_id+'</a>');
      }

      $('#preview_modal').modal('show');
    }
  })
}

/**
 * 删除按钮的实现
 * @Author   Yexk       <yexk@carystudio.com>
 * @DateTime 2017-07-11
 * @param    {Object}   obj                   当前点击的对象
 * @return   {view}                           返回当前操作的情况
 */
function art_deleted(obj)
{
  swal({
    title: "确定要删除吗？",
    text: "该操作会删除“"+$(obj).data('title')+"”文章！",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "确定",
    cancelButtonText: "取消",
    closeOnConfirm: false
  },function(){
    $.ajax({
      url: '{{ route('art.lists') }}',
      type: 'get',
      dataType: 'json',
      data: {'id':$(obj).data('id'),'delOne':'1'},
      success:function(data){
        if (1 == data.code) {
          swal({
            title: data.msg,
            type: "success",
          },function(){
              location.href = location.href;
          });
        }else{
          swal(data.msg, "error");
        }
      }
    });
  });
}

function art_edited(obj) {
  location.href = $(obj).data('href');
}

</script>

@stop
