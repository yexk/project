@extends('back.layouts.default')

@section('title')
首页 @parent
@stop

@section('content')

		  <!-- BEGIN ROW  -->
          <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
              <section class="panel">
                <div class="symbol">
                  <i class="fa fa-tags blue">
                  </i>
                </div>
                <div class="value">
                  <h1 class="count">
                    0
                  </h1>
                  <p>
                    Total Sale
                  </p>
                </div>
              </section>
            </div>
            <div class="col-lg-3 col-sm-6">
              <section class="panel">
                <div class="symbol">
                  <i class="fa fa-money red">
                  </i>
                </div>
                <div class="value">
                  <h1 class=" count2">
                    0
                  </h1>
                  <p>
                    Total Profit
                  </p>
                </div>
              </section>
            </div>
            <div class="col-lg-3 col-sm-6">
              <section class="panel">
                <div class="symbol">
                  <i class="fa fa-user yellow">
                  </i>
                </div>
                <div class="value">
                  <h1 class=" count3">
                    0
                  </h1>
                  <p>
                    New Users
                  </p>
                </div>
              </section>
            </div>
            <div class="col-lg-3 col-sm-6">
              <section class="panel">
                <div class="symbol">
                  <i class="fa fa-shopping-cart purple">
                  </i>
                </div>
                <div class="value">
                  <h1 class=" count4">
                    0
                  </h1>
                  <p>
                    New Orders
                  </p>
                </div>
              </section>
            </div>
          </div>
		   <!-- END ROW  -->
          <div id="morris">
		     <!-- BEGIN ROW  -->
            <div class="row">
              <div class="col-lg-4">
                <div class="panel terques-chart">
                  <div class="panel-body chart-texture">
                    <div class="chart">
                      <div class="heading">
                        <span>
                          Friday
                        </span>
                        <strong>
                          $ 657,00 | 55%
                        </strong>
                      </div>
                      <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[564,123,890,564,455,200,135,667,333,526,996]">
                      </div>
                    </div>
                  </div>
                  <div class="chart-tittle">
                    <span class="title">
                      New Earning
                    </span>
                    <span class="value">
                      <a href="#" class="active">
                        Market
                      </a>
                      |
                      <a href="#">
                        Local
                      </a>
                      |
                      <a href="#">
                        Online
                      </a>
                    </span>
                  </div>
                </div>
                <div class="panel green-chart">
                  <div class="panel-body">
                    <div class="chart">
                      <div class="heading">
                        <span>
                          June
                        </span>
                        <strong>
                          23 Days | 65%
                        </strong>
                      </div>
                      <div id="designchart">
                      </div>
                    </div>
                  </div>
                  <div class="chart-tittle">
                    <span class="title">
                      Total Earn
                    </span>
                    <span class="value">
                      $, 50,23,561
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-lg-2">
                <div class="tiles facebook-tile text-center">
                  <i class="fa fa-facebook icon-lg-size">
                  </i>
                  <h4>
                    <a href="#fakelink">
                      10K likes
                    </a>
                  </h4>
                </div>
                <!-- /.tiles .facebook-tile -->
                <div class="tiles twitter-tile text-center">
                  <i class="fa fa-twitter icon-lg-size">
                  </i>
                  <h4>
                    <a href="#fakelink">
                      2K followers
                    </a>
                  </h4>
                </div>
                <!-- /.tiles .twitter-tile -->
              </div>
              <div class="col-lg-6">
                <section class="panel">
                  <header class="panel-heading">
                    Profit(USD)
                  </header>
                  <div class="panel-body">
                    <div id="hero-area" class="graph">
                    </div>
                  </div>
                </section>
              </div>
            </div>
			 <!-- END ROW  -->
          </div>
		   <!-- BEGIN ROW  -->
          <div class="row">
            <div class="col-lg-8">
              <section class="panel">
                <div class="panel-body">
                  <a href="#" class="task-thumb">
                    <img src="img/avatar1.jpg" alt="">
                  </a>
                  <div class="task-thumb-details">
                    <h1>
                      <a href="#">
                        Work Progress
                      </a>
                    </h1>
                    <p>
                      Pruthvi Bardolia
                    </p>
                  </div>
                </div>
                <table class="table table-hover personal-task">
                  <tbody>
                    <tr>
                      <td>
                        1
                      </td>
                      <td>
                        Target Revenue
                      </td>
                      <td>
                        <span class="badge bg-important">
                          75%
                        </span>
                      </td>
                      <td>
                        <div id="work-progress1">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        2
                      </td>
                      <td>
                        Project Larsen
                      </td>
                      <td>
                        <span class="badge bg-success">
                          43%
                        </span>
                      </td>
                      <td>
                        <div id="work-progress2">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        3
                      </td>
                      <td>
                        Project Nowbie
                      </td>
                      <td>
                        <span class="badge bg-info">
                          67%
                        </span>
                      </td>
                      <td>
                        <div id="work-progress3">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        4
                      </td>
                      <td>
                        Total Sales
                      </td>
                      <td>
                        <span class="badge bg-warning">
                          30%
                        </span>
                      </td>
                      <td>
                        <div id="work-progress4">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        5
                      </td>
                      <td>
                        Delivery Pending
                      </td>
                      <td>
                        <span class="badge bg-primary">
                          15%
                        </span>
                      </td>
                      <td>
                        <div id="work-progress5">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </section>
            </div>
            <div class="col-lg-4">
              <section class="panel post-wrap pro-box">
                <aside>
                  <div class="post-info">
                    <div class="panel-body">
                      <footer class="social-footer">
                        <ul>
                          <li class="active">
                            <a href="#">
                              <i class="fa fa-twitter">
                              </i>
                            </a>
                          </li>
                        </ul>
                      </footer>
                      <!-- END  FOOTER -->
                      <div class="text-center twite">
                        <h1>
                          We just Launch a New Theme Check it Out at
                          <a href="javascript:;">
                            http://olivethemes.in/
                          </a>
                        </h1>
                        <p >
                          4 Days ago
                        </p>
                      </div>
                    </div>
                  </div>
                </aside>
              </section>
            </div>
          </div>
		   <!-- END ROW  -->
		    <!-- BEGIN ROW  -->
          <div class="row">
            <div class="col-lg-6">
              <div class="panel">
                <div class="panel-body">
                  <div class="media usr-info">
                    <a href="#" class="pull-left">
                      <img class="thumb" src="img/avatar1.jpg" alt="">
                    </a>
                    <div class="media-body">
                      <h4 class="media-heading">
                        Pruthvi Bardolia
                      </h4>
                      <span>
                        Chief-Sarathi
                      </span>
                      <p>
                        I handcraft beautiful websites and application for all kind of devices
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <section class="panel">
                <div class="weather-bg">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-xs-6">
                        <i class="fa fa-cloud">
                        </i>
                        New Delhi
                      </div>
                      <div class="col-xs-6">
                        <div class="degree">
                          48°
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <footer class="weather-category">
                  <ul>
                    <li class="active">
                      <h5>
                        humidity
                      </h5>
                      45%
                    </li>
                    <li>
                      <h5>
                        winds
                      </h5>
                      5 mph
                    </li>
                  </ul>
                </footer>
                <!-- END  FOOTER -->
              </section>
            </div>
            <div class="col-lg-6">
              <div class="panel">
                <div class="panel-body">
                  <div class="calendar-block ">
                    <div class="cal1">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		   <!-- END ROW  -->
		    <!-- BEGIN ROW  -->
          <div class="row">
            <div class="col-lg-6">
              <div class="panel">
                <div class="panel-body">
                  <footer class="project-category">
                    <ul>
                      <li class="active">
                        <h5>
                          Project 1
                        </h5>
                        <div id="work-progress6">
                        </div>
                      </li>
                      <li>
                        <h5>
                          Project 2
                        </h5>
                        <div id="work-progress7">
                        </div>
                      </li>
                      <li>
                        <h5>
                          Project 3
                        </h5>
                        <div id="work-progress8">
                        </div>
                      </li>
                    </ul>
                    <h1>
                      Projects accomplished
                    </h1>
                  </footer>
                  <!-- END  FOOTER -->
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="panel">
                <div class="panel-body">
                  <div class="bio-chart">
                    <input class="knob" data-width="100" data-height="100" data-displayPrevious=true data-thickness=".2" value="78" data-fgColor="#f9a3a3" data-bgColor="#e8e8e8">
                    <h4 class="red">
                      Profit
                    </h4>
                  </div>
                  <div class="bio-chart">
                    <input class="knob" data-width="100" data-height="100" data-displayPrevious=true data-thickness=".2" value="63" data-fgColor="#fcce54" data-bgColor="#e8e8e8">
                    <h4 class="yellow">
                      Expansion 
                    </h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
		   <!-- END ROW  -->

@stop

@section('scripts')
<!--Morris-->
<script src="assets/morris.js-0.4.3/morris.min.js" ></script><!-- MORRIS JS -->
<script src="assets/morris.js-0.4.3/raphael-min.js" ></script><!-- MORRIS  JS -->
<script src="js/chart.js" ></script><!-- CHART JS -->
<!--Calendar-->
<script src="js/calendar/clndr.js"></script><!-- CALENDER JS -->
<script src="js/calendar/evnt.calendar.init.js"></script><!-- CALENDER EVENT JS -->
<script src="js/calendar/moment-2.2.1.js"></script><!-- CALENDER MOMENT JS -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script><!-- UNDERSCORE JS -->
<script src="assets/jquery-knob/js/jquery.knob.js" ></script><!-- JQUERY KNOB JS -->
<script >
  //knob
  $(".knob").knob();
  
</script>
@stop