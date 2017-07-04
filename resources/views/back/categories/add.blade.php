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
           <form class="form-horizontal tasi-form" id="cate_add">
              {{ csrf_field() }}
              <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label">文章分类父级</label>
                 <div class="col-sm-10">
                    <select name="pid" class="form-control">
                       <option value="0">顶级分类</option>
                       @foreach ($cate as $v)
                         <option value="{{ $v->id }}">{{ $v->name }}</option>
                       @endforeach
                    </select>
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label">文章分类名称</label>
                 <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" placeholder="文章分类名称">
                    <span id="name_message" class="help-block text-danger" style="display: none;"></span>
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
<script>
$(function(){

  $('input[name="name"]').on('focus', function(event) {
    $('#name_message').hide();
  });

  // 提交表单
  $('#cate_add').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
      url: "{{ route('art.store') }}",
      type: 'POST',
      dataType: 'JSON',
      data: $(this).serialize(),
      success: function(data) {
        console.log(data);
      },
      error: function(data) {
        if (4 == data.readyState && 422 == data.status) {
          var responseText = JSON.parse(data.responseText);
          $('#name_message').show().html(responseText.name[0]);
        }
      }
    });
    
  });

});
</script>
@stop
