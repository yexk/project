@extends('back.layouts.default')

@section('title')
用户管理
@stop

@section('links')
  <link href="css/table-responsive.css" rel="stylesheet"><!-- TABLE RESPONSIVE CSS -->
  <style>
    .div_confirm_msg{height: 29px;line-height: 29px;}
  </style>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
      <section class="panel">
        <header class="panel-heading">
        <button class="btn btn-info"> 添加用户 </button>
        </header>
        <div class="panel-body">
          <section id="no-more-tables">
            <table class="table table-bordered table-striped table-condensed cf">
              <thead class="cf">
                <tr>
                  <th>
                    Id
                  </th>
                  <th style="display: none;">
                    父级ID
                  </th>
                  <th>
                    名称
                  </th>
                  <th>
                    描述
                  </th>
                  <th>
                  操作
                  </th>
                </tr>
              </thead>
              <tbody>
                
                @foreach ($user as $v)
                <tr>
                  <td data-title="Id">
                    {{ $v->id }}
                  </td>
                  <td data-title="父级ID" style="display: none;">
                    {{ $v->pid }}
                  </td>
                  <td data-title="名称">
                    {{ str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v->level) }}  {{ $v->name }}
                  </td>
                  <td data-title="描述">
                    {{ $v->description }}
                  </td>
                  <td data-title="操作">
                    <button data-id="{{ $v->id }}" type="button" class="btn btn-sm btn-round btn-info" data-toggle="modal" data-target="#cate_edits"> edit </button>
                    <button data-id="{{ $v->id }}" type="button" class="btn btn-sm btn-round btn-danger" data-toggle="modal" data-target="#cate_delelte"> delete </button>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
          </section>
        </div>
      </section>
    </div>
  </div>
@stop


@section('others')
<!-- edit Modal -->
<div class="modal fade" id="cate_edits" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">编辑列表</h4>
      </div>
      <form class="cmxform" id="edit_submit">
      <div class="modal-body">
          {{ csrf_field() }}
          <input type="hidden" name="edit_id" id="edit_id" >
          <div class="form-group">
            <label for="edit_cate_pname" class="control-label">上级名称:</label>
            <select class="form-control" name="edit_cate_pname" id="edit_cate_pname" disabled="disabled">
              <option value="0">顶级分类</option>
            </select>
          </div>
          <div class="form-group">
            <label for="edit_cate_name" class="control-label">名称:</label>
            <input type="text" class="form-control" id="edit_cate_name" name="edit_cate_name">
          </div>
          <div class="form-group">
            <label for="edit_cate_description" class="control-label">描述:</label>
            <input type="text" class="form-control" id="edit_cate_description" name="edit_cate_description"></input>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">提交修改</button>
      </div>
      </form>
    </div>
  </div>
</div>


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
<script src="js/jquery.validate.min.js"></script><!-- VALIDATE JS  -->
<script src="js/form-validation-script.js" ></script><!-- FORM VALIDATION SCRIPT JS  -->
<script src="js/bootstrap-switch.js" ></script> <!-- BOOTSTRAP SWITCH JS  -->
<script>
$(function(){
  // 显示模态窗口的数据
  $('#cate_edits').on('show.bs.modal', function (event) {
    var edit_btn_obj = $(event.relatedTarget);
    var edit_td_obj = edit_btn_obj.parent('td').siblings('td');
    $("#edit_id").val(edit_btn_obj.data('id'));
    $("#edit_cate_pname").val($.trim( $(edit_td_obj[1]).text() ));
    $('#edit_cate_name').val( $.trim( $(edit_td_obj[2]).text() ) );
    $('#edit_cate_description').val($.trim( $(edit_td_obj[3]).text() ) );
  });

  // 提交表单
  var $cate_add = $('#edit_submit');
  $cate_add.validate({
    rules: {
        edit_cate_name: "required",
    },
    messages: {
        edit_cate_name: '分类名称不能为空！',
    },
    submitHandler:function () {
      $.ajax({
        url: "{{ route('cate.edits') }}",
        type: 'POST',
        dataType: 'JSON',
        data: $cate_add.serialize(),
        success: function(data) {
          if (1 == data.code) {
            location.href = location.href;
          }
        },
        error: function(data) {
          if (4 == data.readyState && 422 == data.status) {
            var responseText = JSON.parse(data.responseText);
            $('[name="edit_cate_name"]').next().show().html(responseText.name[0]);
          }
        }
      });
    }
  });


  $('#cate_delelte').on('show.bs.modal', function (event) {
    var delete_btn_obj = $(event.relatedTarget);
    $('#btn_cate_delete').data('id',delete_btn_obj.data('id'));
    $('#_force').parent('div').hide();
    $('#div_confirm_msg').html('确定要删除吗？');
  });
  $('#btn_cate_delete').on('click', function(event) {
    var data = {};
    data.delete_id = $(this).data('id');
    data._token = Config._token;
    data._delete = true;
    data._force = $('#_force').bootstrapSwitch('status');
      $.ajax({
        url: "{{ route('cate.edits') }}",
        type: 'POST',
        dataType: 'JSON',
        data: data,
        success: function(data) {
          if (1 == data.code) {
            $('#cate_delelte').modal('hide');
            swal({
              title: "删除成功",
              text: "",
              type: "success",
            },function(){
              location.href = location.href;
            });
          }else if(2 == data.code){
            $('#_force').parent('div').show();
            $('#div_confirm_msg').css('color', 'red').html('该元素存在子集，请确定是否要强制删除（该操作会同时删除存在的子集）');
          }else{
            swal({
              title: "未知异常",
              text: '',
              type: "error",
            })
          }
        },
        error: function(data) {
          if (4 == data.readyState && 422 == data.status) {
            var responseText = JSON.parse(data.responseText);
            swal({
              title: "未知异常",
              text: responseText,
              type: "error",
            },function(){

            });
          }
        }
      });
    

  }); 


});
</script>
@stop
