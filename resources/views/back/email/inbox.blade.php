@extends('back.layouts.default')

@section('title')
邮箱列表
@stop

@section('links')

@stop

@section('content')
<div class="mail-box">
  <aside class="sm-side">
<!-- INBOX HEADER -->
     <div class="user-head">
        <a href="javascript:;" class="inbox-avatar">
        <img src="img/mail-avatar.jpg" alt="">
        </a>
        <div class="user-name">
           <h5><a href="#">{{ config('mail.from.name') }}</a></h5>
           <span><a href="#">{{ config('mail.from.address') }}</a></span>
        </div>
        <a href="javascript:;" class="mail-dropdown pull-right">
        <i class="fa fa-chevron-down"></i>
        </a>
     </div>
      <!-- INBOX HEADER -->
      <!-- INBOX BODY -->
     <div class="inbox-body">
        <a class="btn btn-compose" data-toggle="modal" href="#myModal">
        写邮件
        </a>
        <div class="modal fade" id="myModal">
           <div class="modal-dialog modal-lg">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">写邮件</h4>
                 </div>
                 <div class="modal-body">
                    <form id="sendmessage" class="form-horizontal" role="form">
                       <div class="form-group">
                          <label class="col-lg-2 control-label">收件人<i style="color:red">*</i></label>
                          <div class="col-lg-10">
                             <input type="text" class="form-control" id="to" placeholder="">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-lg-2 control-label">抄送</label>
                          <div class="col-lg-10">
                             <input type="text" class="form-control" id="cc" placeholder="">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-lg-2 control-label">密送</label>
                          <div class="col-lg-10">
                             <input type="text" class="form-control" id="bcc" placeholder="">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-lg-2 control-label">主题<i style="color:red">*</i></label>
                          <div class="col-lg-10">
                             <input type="text" class="form-control" id="subject" placeholder="">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-lg-2 control-label">内容<i style="color:red">*</i></label>
                          <div class="col-lg-10">
                             <textarea name="" id="message" class="form-control" cols="30" rows="10"></textarea>
                          </div>
                       </div>
                       <div class="form-group">
                          <div class="col-lg-offset-2 col-lg-10">
                             <!-- <span class="btn green fileinput-button">
                             <i class="fa fa-plus fa fa-white"></i>
                             <span>附件</span>
                             <input type="file" multiple="" name="files[]">
                             </span> -->
                             <button type="submit" class="btn btn-send">发送</button>
                          </div>
                       </div>
                    </form>
                 </div>
              </div>
           </div>
        </div>
     </div>
<!-- INBOX HEADER -->
<!-- INBOX NAV -->
     <ul class="inbox-nav inbox-divider">
        <li class="active">
           <a href="#"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right">2</span></a>
        </li>
        <li>
           <a href="#"><i class="fa fa-envelope-o"></i> Sent Mail</a>
        </li>
        <li>
           <a href="#"><i class="fa fa-bookmark-o"></i> Important</a>
        </li>
        <li>
           <a href="#"><i class=" fa fa-external-link"></i> Drafts <span class="label label-info pull-right">30</span></a>
        </li>
        <li>
           <a href="#"><i class=" fa fa-trash-o"></i> Trash</a>
        </li>
     </ul>
     <ul class="nav nav-pills nav-stacked labels-info inbox-divider">
        <li>
           <h4>Labels</h4>
        </li>
        <li> <a href="#"> <i class=" fa fa-sign-blank text-danger"></i> Work </a> </li>
        <li> <a href="#"> <i class=" fa fa-sign-blank text-success"></i> Design </a> </li>
        <li> <a href="#"> <i class=" fa fa-sign-blank text-info "></i> Family </a>
        </li><li> <a href="#"> <i class=" fa fa-sign-blank text-warning "></i> Friends </a>
        </li><li> <a href="#"> <i class=" fa fa-sign-blank text-primary "></i> Office </a></li>
     </ul>
     <ul class="nav nav-pills nav-stacked labels-info ">
        <li>
           <h4>Buddy online</h4>
        </li>
        <li>
           <a href="#">
              <i class=" fa fa-comments text-success"></i> Chintan Pandya 
              <p>I do not think</p>
           </a>
        </li>
        <li>
           <a href="#">
              <i class=" fa fa-comments text-danger"></i> Parth Jani 
              <p>Busy with coding</p>
           </a>
        </li>
        <li>
           <a href="#">
              <i class=" fa fa-comments text-warning "></i> Anjelina Joli 
              <p>I out of control</p>
           </a>
        </li><li>
           <a href="#">
              <i class=" fa fa-comments text-muted "></i> Bill gates 
              <p>I am not here</p>
           </a>
        </li><li>
           <a href="#">
              <i class=" fa fa-comments text-success "></i> Jay Bardolia 
              <p>I do not think</p>
           </a>
        </li>
     </ul>
     <div class="inbox-body text-center">
        <div class="btn-group">
           <a href="javascript:;" class="btn mini btn-danger">
           <i class="fa fa-power-off"></i>
           </a>
        </div>
        <div class="btn-group">
           <a href="javascript:;" class="btn mini btn-primary">
           <i class="fa fa-cogs"></i>
           </a>
        </div>
     </div>
  </aside>
<!-- INBOX MAIL CONTAINER -->
  <aside class="lg-side">
     <div class="inbox-head">
        <h3>Inbox</h3>
        <form class="pull-right position" action="#">
           <div class="input-append">
              <input type="text" placeholder="Search Mail" class="sr-input">
              <button type="button" class="btn sr-btn"><i class="fa fa-search"></i></button>
           </div>
        </form>
     </div>
     <div class="inbox-body">
        <div class="mail-option">
           <div class="chk-all">
              <input type="checkbox" class="mail-checkbox mail-group-checkbox">
              <div class="btn-group">
                 <a class="btn mini all" href="#" data-toggle="dropdown">
                 All
                 <i class="fa fa-angle-down "></i>
                 </a>
                 <ul class="dropdown-menu">
                    <li><a href="#"> None</a></li>
                    <li><a href="#"> Read</a></li>
                    <li><a href="#"> Unread</a></li>
                 </ul>
              </div>
           </div>
           <div class="btn-group">
              <a class="btn mini tooltips" href="#" data-toggle="dropdown" data-placement="top" data-original-title="Refresh">
              <i class=" fa fa-refresh"></i>
              </a>
           </div>
           <div class="btn-group hidden-phone">
              <a class="btn mini blue" href="#" data-toggle="dropdown">
              More
              <i class="fa fa-angle-down "></i>
              </a>
              <ul class="dropdown-menu">
                 <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                 <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                 <li class="divider"></li>
                 <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
              </ul>
           </div>
           <div class="btn-group">
              <a class="btn mini blue" href="#" data-toggle="dropdown">
              Move to
              <i class="fa fa-angle-down "></i>
              </a>
              <ul class="dropdown-menu">
                 <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                 <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                 <li class="divider"></li>
                 <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
              </ul>
           </div>
           <ul class="unstyled inbox-pagination">
              <li><span>1-50 of 234</span></li>
              <li>
                 <a href="#" class="np-btn"><i class="fa fa-angle-left  pagination-left"></i></a>
              </li>
              <li>
                 <a href="#" class="np-btn"><i class="fa fa-angle-right pagination-right"></i></a>
              </li>
           </ul>
        </div>
        <table class="table table-inbox table-hover">
           <tbody>
              <tr class="unread">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message  dont-show">Olive Design Hub</td>
                 <td class="view-message ">Lorem ipsum dolor imit set.</td>
                 <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                 <td class="view-message  text-right">9:27 AM</td>
              </tr>
              <tr class="unread">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message dont-show">Chintan Pandya</td>
                 <td class="view-message">Hi Bro, How are you?</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">March 15</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message dont-show">Bill Gates</td>
                 <td class="view-message">Plese Join My Company</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">June 15</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message dont-show">Mark Zukerberg</td>
                 <td class="view-message">I Have an Error Please Solved This.</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">April 01</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star inbox-started"></i></td>
                 <td class="view-message dont-show">Mark Zukerberg<span class="label label-danger pull-right">urgent</span></td>
                 <td class="view-message">We Bought Twitter What U Say..? Reply</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">May 23</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star inbox-started"></i></td>
                 <td class="view-message dont-show">Facebook</td>
                 <td class="view-message">Anil Ambani,Add You As Friend. Confirm?</td>
                 <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                 <td class="view-message text-right">March 14</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star inbox-started"></i></td>
                 <td class="view-message dont-show">Obama</td>
                 <td class="view-message">Comment On Your Photo.</td>
                 <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                 <td class="view-message text-right">January 19</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message dont-show">Facebook <span class="label label-success pull-right">megazine</span></td>
                 <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">March 04</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message dont-show">Chintan</td>
                 <td class="view-message view-message">Lorem ipsum dolor sit amet</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">June 13</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message dont-show">Facebook <span class="label label-info pull-right">family</span></td>
                 <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">March 24</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star inbox-started"></i></td>
                 <td class="view-message dont-show">Chintan <span class="label label-primary pull-right">Social</span></td>
                 <td class="view-message">Lorem ipsum dolor sit amet</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">March 09</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star inbox-started"></i></td>
                 <td class="dont-show">Facebook</td>
                 <td class="view-message">Dolor sit amet, consectetuer adipiscing</td>
                 <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                 <td class="view-message text-right">May 14</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message dont-show">Parth</td>
                 <td class="view-message">Lorem ipsum dolor sit amet</td>
                 <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                 <td class="view-message text-right">February 25</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="dont-show">Facebook</td>
                 <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">March 14</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message dont-show">Dulal <span class="label label-primary pull-right">Company</span></td>
                 <td class="view-message">Lorem ipsum dolor sit amet</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">April 07</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message dont-show">Twitter</td>
                 <td class="view-message">Dolor sit amet, consectetuer adipiscing</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">July 14</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star inbox-started"></i></td>
                 <td class="view-message dont-show">Parth</td>
                 <td class="view-message">Lorem ipsum dolor sit amet</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">August 10</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message dont-show">Facebook</td>
                 <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                 <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                 <td class="view-message text-right">April 14</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message dont-show">Chintan</td>
                 <td class="view-message">Lorem ipsum dolor sit amet</td>
                 <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                 <td class="view-message text-right">June 16</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star inbox-started"></i></td>
                 <td class="view-message dont-show">Parth</td>
                 <td class="view-message">Lorem ipsum dolor sit amet</td>
                 <td class="view-message inbox-small-cells"></td>
                 <td class="view-message text-right">August 10</td>
              </tr>
              <tr class="">
                 <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox">
                 </td>
                 <td class="inbox-small-cells hidden-phone"><i class="fa fa-star"></i></td>
                 <td class="view-message dont-show">Facebook <span class="label label-primary pull-right">megazine</span></td>
                 <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                 <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                 <td class="view-message text-right">April 14</td>
              </tr>
           </tbody>
        </table>
     </div>
  </aside>
<!-- INBOX MAIL CONTAINER -->
</div>


@stop


@section('others')

@stop

@section('scripts')
<script>
$(function(){
  $('#sendmessage').on('submit', function(event) {
      event.preventDefault();
      var data = {};
      data._token = Config._token;
      data.to = $('#to').val();
      data.cc = $('#cc').val();
      data.bcc = $('#bcc').val();
      data.subject = $('#subject').val();
      data.message = $('#message').val();
      if ( !data.to || !data.subject || !data.message )
      {
        swal('带“*”号的为必填项','','error');
        return false;
      }
      $.ajax({
          url: '{{ route("mail.send") }}',
          type: 'POST',
          dataType: 'text',
          data: data,
          success:function(data){
            swal({
              title: '发送成功！',
              text: '',
              type: "success",
            },function(){
              location.href = location.href;
            });
          }
      })
      return false;
  });
});
</script>
@stop
