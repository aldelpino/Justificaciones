
@extends('layouts.admin')

@section('content')
  <!-- page content -->
  <div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Alumnos</span>
        <div class="count">2,500</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Coordinadores</span>
        <div class="count">16</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-clock-o"></i> Promedio Respuesta</span>
        <div class="count">12.3</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Justificaciones</span>
        <div class="count green">9,640</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Pendientes</span>
        <div class="count">2,315</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Respondidas</span>
        <div class="count">7,325</div>
      </div>
    </div>
    <!-- /top tiles -->

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="dashboard_graph">
          <div class="row x_title">
            <div class="col-md-6">
              <h3>Registro Promedio <small>Respuestas V/S Pendientes</small></h3>
            </div>
            <div class="col-md-6">
              <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                <span>December 30, 2018 - January 28, 2019</span> <b class="caret"></b>
              </div>
            </div>
          </div>

          <div class="col-md-9 col-sm-9 col-xs-12">
            <div id="chart_plot_01" class="demo-placeholder"></div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
            <div class="x_title">
              <h2>Top Coordinadores Del Mes</h2>
              <div class="clearfix"></div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-6">
              <div>
                <p>Camila Gonzalez Herrera</p>
                <div class="">
                  <div class="progress progress_sm" style="width: 76%;">
                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                  </div>
                </div>
              </div>
              <div>
                <p>Fernando Arriagada Mejias</p>
                <div class="">
                  <div class="progress progress_sm" style="width: 76%;">
                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-6">
              <div>
                <p>Carolina Aedo Reyes</p>
                <div class="">
                  <div class="progress progress_sm" style="width: 76%;">
                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                  </div>
                </div>
              </div>
              <div>
                <p>Mitzi Zepeda Enoch</p>
                <div class="">
                  <div class="progress progress_sm" style="width: 76%;">
                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="20"></div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="clearfix"></div>
        </div>
      </div>

    </div>
    <br />
  <!-- /page content -->
@endsection
