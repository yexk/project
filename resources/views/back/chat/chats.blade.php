@extends('back.layouts.default')

@section('title')
聊天室
@stop

@section('content')
<div class="col-sm-3">
  <section class="panel">
    <header class="panel-heading">
      <div class="input-group text-sm">
        <input class="input-sm form-control" placeholder="Search" type="text">
        <div class="input-group-btn">
          <button type="button" class="btn btn-sm btn-white dropdown-toggle" data-toggle="dropdown">
            Action 
            <span class="caret">
            </span>
          </button>
          <ul class="dropdown-menu pull-right">
            <li>
              <a href="#">
                Action
              </a>
            </li>
            <li>
              <a href="#">
                Another action
              </a>
            </li>
            <li>
              <a href="#">
                Something else here
              </a>
            </li>
            <li class="divider">
            </li>
            <li>
              <a href="#">
                Separated link
              </a>
            </li>
          </ul>
        </div>
      </div>
    </header>
    <ul class="list-group alt">
      <li class="list-group-item">
        <div class="media">
          <span class="pull-left thumb-sm">
            <img src="img/chat-avatar2.jpg" alt="John said" class="img-circle">
          </span>
          <div class="pull-right text-success m-t-sm">
            <i class="fa fa-circle">
            </i>
          </div>
          <div class="media-body">
            <div>
              <a href="#">
                Pruthvi Bardolia
              </a>
            </div>
            <small class="text-muted">
              about 2 minutes ago
            </small>
          </div>
        </div>
      </li>
      <li class="list-group-item">
        <div class="media">
          <span class="pull-left thumb-sm">
            <img src="img/chat-avatar.jpg" alt="John said" class="img-circle">
          </span>
          <div class="pull-right text-muted m-t-sm">
            <i class="fa fa-circle">
            </i>
          </div>
          <div class="media-body">
            <div>
              <a href="#">
                Chintan Pandya
              </a>
            </div>
            <small class="text-muted">
              about 2 hours ago
            </small>
          </div>
        </div>
      </li>
      <li class="list-group-item">
        <div class="media">
          <span class="pull-left thumb-sm">
            <img src="img/chat-avatar2.jpg" alt="John said" class="img-circle">
          </span>
          <div class="pull-right text-warning m-t-sm">
            <i class="fa fa-circle">
            </i>
          </div>
          <div class="media-body">
            <div>
              <a href="#">
                Pruthvi Bardolia
              </a>
            </div>
            <small class="text-muted">
              3 days ago
            </small>
          </div>
        </div>
      </li>
      <li class="list-group-item">
        <div class="media">
          <span class="pull-left thumb-sm">
            <img src="img/chat-avatar.jpg" alt="John said" class="img-circle">
          </span>
          <div class="pull-right text-danger m-t-sm">
            <i class="fa fa-circle">
            </i>
          </div>
          <div class="media-body">
            <div>
              <a href="#">
                Chintan Pandya
              </a>
            </div>
            <small class="text-muted">
              about 2 minutes ago
            </small>
          </div>
        </div>
      </li>
    </ul>
  </section>
</div>
<div class="col-lg-6">
  <!-- START PANEL -->
  <section class="panel">
    <header class="panel-heading">
      Chats
      <span class="tools pull-right">
        <a class="fa fa-chevron-down" href="javascript:;">
        </a>
        <a class="fa fa-times" href="javascript:;">
        </a>
      </span>
    </header>
    <div class="panel-body">
      <div class="timeline-messages">
        <div class="msg-time-chat">
          <a href="#" class="message-img">
            <img class="avatar" src="img/chat-avatar.jpg" alt="">
          </a>
          <div class="message-body msg-in">
            <div class="text">
              <p class="attribution">
                <a href="#">
                  Chintan
                </a>
                at 1:55pm, 13th April 2013
              </p>
              <p>
                Hello, How are you brother?
              </p>
            </div>
          </div>
        </div>
        <div class="msg-time-chat">
          <a href="#" class="message-img">
            <img class="avatar" src="img/chat-avatar2.jpg" alt="">
          </a>
          <div class="message-body msg-out">
            <div class="text">
              <p class="attribution">
                
                <a href="#">
                  Pruthvi
                </a>
                at 2:01pm, 13th April 2013
              </p>
              <p>
                I'm Fine, Thank you. What about you? How is going on?
              </p>
            </div>
          </div>
        </div>
        <div class="msg-time-chat">
          <a href="#" class="message-img">
            <img class="avatar" src="img/chat-avatar.jpg" alt="">
          </a>
          <div class="message-body msg-in">
            <div class="text">
              <p class="attribution">
                <a href="#">
                  Chintan
                </a>
                at 2:03pm, 13th April 2013
              </p>
              <p>
                Yeah I'm fine too. Everything is going fine here.
              </p>
            </div>
          </div>
        </div>
        <div class="msg-time-chat">
          <a href="#" class="message-img">
            <img class="avatar" src="img/chat-avatar2.jpg" alt="">
          </a>
          <div class="message-body msg-out">
            <span class="arrow">
            </span>
            <div class="text">
              <p class="attribution">
                <a href="#">
                  Pruthvi
                </a>
                at 2:05pm, 13th April 2013
              </p>
              <p>
                well good to know that. anyway how much time you need to done your task?
              </p>
            </div>
          </div>
        </div>
        <div class="msg-time-chat">
          <a href="#" class="message-img">
            <img class="avatar" src="img/chat-avatar.jpg" alt="">
          </a>
          <div class="message-body msg-in">
            <span class="arrow">
            </span>
            <div class="text">
              <p class="attribution">
                <a href="#">
                  Chintan
                </a>
                at 1:55pm, 13th April 2013
              </p>
              <p>
                Hello, How are you brother?
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="chat-form">
        <div class="input-cont ">
          <input type="text" class="form-control col-lg-12" placeholder="Type a message here...">
        </div>
        <div class="form-group">
          <div class="pull-right chat-features">
            <a class="btn btn-info btn-lg" href="javascript:;">
              Send
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END PANEL -->
</div>
@stop

@section('scripts')
<script>
  // 假设服务端ip为127.0.0.1
ws = new WebSocket("ws://127.0.0.1:11104");
ws.onopen = function() {
    alert("连接成功");
    ws.send('tom');
    alert("给服务端发送一个字符串：tom");
};
ws.onmessage = function(e) {
    alert("收到服务端的消息：" + e.data);
};  
</script>
@stop
