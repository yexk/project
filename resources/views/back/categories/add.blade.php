@extends('back.layouts.default')

@section('title')
文章分类添加
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
           <form class="cmxform form-horizontal tasi-form" id="cate_add">
              {{ csrf_field() }}
              <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label">文章分类父级</label>
                 <div class="col-sm-10">
                    <select name="pid" class="form-control">
                       <option value="0">顶级分类</option>
                       @foreach ($cate as $v)
                         <option value="{{ $v->id }}">{{ str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v->level) }} {{ $v->name }}</option>
                       @endforeach
                    </select>
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label">文章分类名称</label>
                 <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" placeholder="文章分类名称" required="">
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label">文章分类描述</label>
                 <div class="col-sm-10">
                    <input type="text" name="description" class="form-control" placeholder="文章分类描述">
                 </div>
              </div>
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
<script src="js/form-validation-script.js" ></script><!-- FORM VALIDATION SCRIPT JS  -->
<script>
$(function(){

  $('input[name="name"]').on('focus', function(event) {
    $('#name_message').hide();
  });

  // 提交表单
  var $cate_add = $('#cate_add');
  $cate_add.validate({
        rules: {
            name: "required",
        },
        messages: {
            name: '分类名称不能为空！',
        },
        submitHandler:function () {
          $.ajax({
            url: "{{ route('art.store') }}",
            type: 'POST',
            dataType: 'JSON',
            data: $cate_add.serialize(),
            success: function(data) {
              if (1 == data.code) {
                alert(data.msg);
                location.href = location.href;
              }
            },
            error: function(data) {
              if (4 == data.readyState && 422 == data.status) {
                var responseText = JSON.parse(data.responseText);
                $('[name="name"]').next().show().html(responseText.name[0]);
              }
            }
          });
        }
    });    
  
});
</script>
@stop
