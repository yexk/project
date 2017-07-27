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
        <button class="btn btn-info" data-toggle="modal" data-target="#modal_add_user" > 添加用户 </button>
        </header>
        <div class="panel-body">
          <section id="no-more-tables">
            <table class="table table-bordered table-striped table-condensed cf">
              <thead class="cf">
                <tr>
                  <th> Id </th>
                  <th> 用户名 </th>
                  <th> 昵称 </th>
                  <th> 邮箱</th>
                  <th> 操作 </th>
                </tr>
              </thead>
              <tbody>
                
                @foreach ($user as $v)
                <tr>
                  <td data-title="Id">
                    {{ $v->id }}
                  </td>
                  <td data-title="用户名">
                    {{ $v->username }}
                  </td>
                  <td data-title="昵称">
                    {{ $v->name }}
                  </td>
                  <td data-title="邮箱">
                    {{ $v->email }}
                  </td>
                  <td data-title="操作">
                    <button data-id="{{ $v->id }}" type="button" class="btn btn-sm btn-round btn-info" data-toggle="modal" data-target="#user_edits"> 重置密码 </button>
                    @if ( 1 != $v->id )
                    <button data-id="{{ $v->id }}" type="button" class="btn btn-sm btn-round btn-info" data-toggle="modal" data-target="#user_modify"> 编辑 </button>
                    <button data-id="{{ $v->id }}" data-username="{{ $v->username }}" type="button" class="btn btn-sm btn-round btn-danger" onclick="user_delelte(this)"> 删除 </button>
                    @endif
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
<!-- add modal -->
<div class="modal fade" id="modal_add_user" tabindex="-1" role="dialog" aria-labelledby="modal_user">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal_user">添加用户</h4>
      </div>
      <form class="cmxform" onsubmit="return false">
      <div class="modal-body">
          <div class="form-group">
            <label for="add_username" class="control-label">用户名：</label>
            <input type="text" class="form-control" id="add_username" name="add_username">
          </div>
          <div class="form-group">
            <label for="add_password" class="control-label">密码：</label>
            <input type="password" class="form-control" id="add_password" name="add_password">
          </div>
          <div class="form-group">
            <label for="add_repassword" class="control-label">确认密码：</label>
            <input type="password" class="form-control" id="add_repassword" name="add_repassword">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button id="add_user_submit" type="button" class="btn btn-primary">添加</button>
      </div>
    </div>
  </div>
</div>

<!-- user_modify modal -->
<div class="modal fade" id="user_modify" tabindex="-1" role="dialog" aria-labelledby="modal_user">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal_user">修改用户</h4>
      </div>
      <form class="cmxform" onsubmit="return false">
      <div class="modal-body">
          <div class="form-group">
            <label for="modify_username" class="control-label">用户名：</label>
            <input type="text" class="form-control" id="modify_username" name="modify_username">
            <input type="hidden" id="modify_id" name="modify_id">
          </div>
          <div class="form-group">
            <label for="modify_name" class="control-label">昵称：</label>
            <input type="text" class="form-control" id="modify_name" name="modify_name">
          </div>
          <div class="form-group">
            <label for="modify_email" class="control-label">邮箱：</label>
            <input type="text" class="form-control" id="modify_email" name="modify_email">
          </div>
          <div class="form-group">
            <label for="modify_password" class="control-label">密码：</label>
            <input type="password" class="form-control" id="modify_password" name="modify_password" placeholder="留空代表不修改密码">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button id="modify_user_submit" type="button" class="btn btn-primary">提交修改</button>
      </div>
    </div>
    </form>
  </div>
</div>


<!-- edit Modal -->
<div class="modal fade" id="user_edits" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">修改用户密码</h4>
      </div>
      <form class="cmxform" onsubmit="return false">
      <div class="modal-body">
          <input type="hidden" name="edit_id" id="edit_id" >
          <div class="form-group">
            <label for="edit_username" class="control-label">用户名：</label>
            <input type="text" class="form-control" id="edit_username" name="edit_username" disabled="disabled">
          </div>
          <div class="form-group">
            <label for="edit_old_password" class="control-label">原密码：</label>
            <input type="password" class="form-control" id="edit_old_password" name="edit_old_password">
          </div>
          <div class="form-group">
            <label for="edit_new_password" class="control-label">新密码：</label>
            <input type="password" class="form-control" id="edit_new_password" name="edit_new_password">
          </div>
          <div class="form-group">
            <label for="edit_new_repassword" class="control-label">确认新密码：</label>
            <input type="password" class="form-control" id="edit_new_repassword" name="edit_new_repassword">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button id="edit_user_submit" type="button" class="btn btn-primary">提交修改</button>
      </div>
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
  // 提交用户添加的数据
  $('#add_user_submit').on('click', function(event) {
    event.preventDefault();
    var data       = {};
    var username   = $('#add_username').val();
    var password   = $('#add_password').val();
    var repassword = $('#add_repassword').val();
    if ('' == username || '' == password || '' == repassword) {
      swal({
        title: "用户名或者密码不能为空！",
        type: "error",
      });
      return false;
    }
    if (password !== repassword) {
      swal({
        title: "两次密码不一样！",
        type: "error",
      });
      return false;
    }
    data.username = username;
    data.password = password;
    data._token = Config._token;
    $.ajax({
      url: "{{ route('users.add') }}",
      type: 'POST',
      dataType: 'json',
      data: data,
      success:function(data){
        if (1 == data.code) {
          location.href = location.href;
        }else{
          swal({
            title: data.msg,
            type: "error",
          });
        }
      }
    })
  });

  $('#user_edits').on('show.bs.modal', function (event) {
    var edit_btn_obj = $(event.relatedTarget);
    var edit_td_obj = edit_btn_obj.parent('td').siblings('td');
    $("#edit_id").val(edit_btn_obj.data('id'));
    $("#edit_username").val($.trim( $(edit_td_obj[1]).text() ));
  });  

$('#user_modify').on('show.bs.modal', function (event) {
    var edit_btn_obj = $(event.relatedTarget);
    var edit_td_obj = edit_btn_obj.parent('td').siblings('td');
    $("#modify_id").val(edit_btn_obj.data('id'));
    $("#modify_username").val($.trim( $(edit_td_obj[1]).text() ));
    $("#modify_name").val($.trim( $(edit_td_obj[2]).text() ));
    $("#modify_email").val($.trim( $(edit_td_obj[3]).text() ));
});

    $('#modify_user_submit').on('click', function(event) {
        event.preventDefault();
        var data      = {};
        data.id       = $("#modify_id").val();
        data.username = $("#modify_username").val();
        data.name     = $("#modify_name").val();
        data.email    = $("#modify_email").val();
        data.password = $("#modify_password").val();
        data._token   = Config._token;
        if (!data.id || !data.username || !data.name || !data.email) {
            swal({
            title: "资料不能为空！",
            type: "error",
          });
          return false;
        }
        $.ajax({
            url: "{{ route('users.add') }}",
            type: 'POST',
            dataType: 'json',
            data: data,
            success:function(data){
                if (1 == data.code) {
                    location.href = location.href;
                }else{
                    swal({
                        title: data.msg,
                        type: "error",
                    });
                }
            },
            error: function(data) {
              if (4 == data.readyState && 422 == data.status) {
                var responseText = JSON.parse(data.responseText);
                console.log(responseText);
                swal(responseText.password[0],'','error');
              }
            }
        });
  });


  // 提交修改的用户数据
  $('#edit_user_submit').on('click', function(event) {
    event.preventDefault();
    var data = {}
    var edit_old_password   = $('#edit_old_password').val();
    var edit_new_password   = $('#edit_new_password').val();
    var edit_new_repassword = $('#edit_new_repassword').val();
    if (!edit_old_password || !edit_new_password || !edit_new_repassword) {
       swal({
        title: "密码不能为空！",
          type: "error",
        });
        return false;
    }
    if (edit_new_password !== edit_new_repassword) {
      swal({
        title: "两次密码不一样！",
        type: "error",
      });
      return false;
    }
    data.id = $("#edit_id").val();
    data.modifypassword = 1;
    data.oldpassword = $("#edit_old_password").val();
    data.newpassword = $("#edit_new_password").val();
    data._token = Config._token;
    $.ajax({
      url: "{{ route('users.add') }}",
      type: 'POST',
      dataType: 'json',
      data: data,
      success:function(data){
        if (1 == data.code) {
          swal({
            title: data.msg,
            type: "success",
          },function(){
            location.href = location.href;
          });
        }else{
          swal({
            title: data.msg,
            type: "error",
          });
        }
      }
    });
  });
});

function user_delelte(obj) {
    var username = $(obj).data('username');
    var data     = {};
    data.id      = $(obj).data('id');
    data.userdel = 1;
    data._token  = Config._token;
    swal({
      title: "确定要删除吗？",
      text: "该操作会删除【"+username+"】用户！",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      closeOnConfirm: false,
    },function(isdel){
        if (isdel) {
            $.ajax({
                url: "{{ route('users.add') }}",
                type: 'POST',
                dataType: 'json',
                data: data,
                success:function(data){
                    if (1 == data.code) {
                    swal({
                      title: "删除成功",
                      text: "",
                      type: "success",
                    },function(){
                      location.href = location.href;
                    });
                  }else{
                    swal({
                      title: "未知异常",
                      text: '',
                      type: "error",
                    });
                  }
                }
            });
        }
    });
}


</script>
@stop
