@extends('back.layouts.default')

@section('title')
文章添加
@stop


@section('links')
<link rel="stylesheet" type="text/css" href="assets/bootstrap-datetimepicker/css/datetimepicker.css"><!-- DATETIMEPICKER PLUGIN CSS -->
<link href="/common/css/editormd.min.css" rel="stylesheet"><!-- editormd CSS -->
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
     <section class="panel">
        <header class="panel-heading">
           <span class="label label-primary">文章分类添加</span>
           </span>
        </header>
        <div class="panel-body">
           <form class="cmxform form-horizontal tasi-form" id="art_add">
              {{ csrf_field() }}
              <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label"> 文章分类 </label>
                 <div class="col-sm-10">
                    <select name="cate_id" class="form-control">
                       @foreach ($cate as $v)
                         <option value="{{ $v->id }}">{{ str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v->level) }} {{ $v->name }}</option>
                       @endforeach
                    </select>
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label"> 文章标题 </label>
                 <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" placeholder="文章分类名称" >
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label"> 文章描述 </label>
                 <div class="col-sm-10">
                    <input type="text" name="description" class="form-control" placeholder="文章分类描述">
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label"> 文章标签 </label>
                 <div class="col-sm-10">
                   <input type="text" name="label" id="label" class="tagsinput" value="">
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label"> 发布时间 </label>
                 <div class="col-sm-10">
                    <input size="16" id="public_at" name="public_at" type="text" class="form_datetime form-control" readonly placeholder="请选择一个时间，默认为当前时间">
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label"> 文章内容 </label>
                 <div class="col-sm-10">
                  <div id="content" name="content">
                    <textarea style="display:none;"></textarea>
                  </div>
                 </div>
              </div>
              <!-- - - -->
              <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label"> </label>
                 <div class="col-sm-10">
                    <button type="submit" class="btn btn-info">Submit</button>
                 </div>
              </div>
           </form>
        </div>
     </section>
  </div>
</div>
@stop

@section('scripts')
<script src="js/jquery.validate.min.js"></script><!-- VALIDATE JS  -->
<script src="js/jquery.tagsinput.js" ></script> <!-- TAGS INPUT JS  -->
<script src="assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script><!-- BOOTSTRAP DATETIMEPICKER JS  -->
<script src="/common/js/editormd.js"></script><!-- SWEETALERT JS -->
<script>
var art_content;
$(function(){
  $(".tagsinput").tagsInput();
  $(".form_datetime").datetimepicker({
      todayBtn: true,
      autoclose: true,
      format: 'yyyy-mm-dd hh:ii'
  });
  art_content = editormd("content", {
      height  : 550,
      placeholder:'从这里开始写吧。。。',
      syncScrolling : "single",
      path    : "/common/js/lib/",
      toolbarIcons : function() {
        return ["undo", "redo", "|","bold","del","hr","quote", "|", "table","reference-link","image","code","datetime","|","html-entities", "||", "watch", "preview"];
      },
      imageUpload    : true,
      imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
      imageUploadURL : "{{ route('art.lists') }}",
  });
    

  $('input[name="title"]').on('focus', function(event) {
    $('#name_message').hide();
  });

  // 提交表单
  var $art_add = $('#art_add');
  $art_add.validate({
        rules: {
            title: "required",
            cate_id: "required",
        },
        messages: {
            title: '标题不能为空！',
            cate_id: '分类不能为空！',
        },
        submitHandler:function () {
          $.ajax({
            url: "{{ route('art.store') }}",
            type: 'POST',
            dataType: 'JSON',
            data: $art_add.serialize(),
            success: function(data) {
              if (1 == data.code) {
                swal({
                  title: data.msg,
                  text: '',
                  type: "success",
                },function(){
                  location.href = location.href;
                });
              }
            },
            error: function(data) {
              if (4 == data.readyState && 422 == data.status) {
                var responseText = JSON.parse(data.responseText);
                if (responseText['content-markdown-doc']) {
                  swal({
                    title: '文章内容不能为空！',
                    text: '',
                    type: "error",
                  });
                }else{
                  swal({
                    title: responseText['title'][0],
                    text: '',
                    type: "error",
                  },function(){
                    $('[name="title"]').next().show().html(responseText.title[0]);
                  });
                }
              }
            }
          });
        }
    });    
  
});

</script>
@stop
