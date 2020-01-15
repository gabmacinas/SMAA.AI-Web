@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
      <h1>
        SMAA.AI
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        {{-- <li class="active">Widgets</li> --}}
      </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Buying Power</span>
              <span class="info-box-number">${{ number_format($account['buying_power'],2) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Cash</span>
              <span class="info-box-number">${{ number_format($account['cash'],2) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Portfolio Value</span>
              <span class="info-box-number">${{ number_format($account['portfolio_value'],2) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-line-chart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Status</span>
              <span class="info-box-number">{{ $account['status'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
    </div>
        <div class="row">
          <div class="col-md-6">
            <div class="box" data-vivaldi-spatnav-clickable="1">
              <div class="box-header">
                <h3 class="box-title">Portfolio</h3>

                <div class="box-tools">
                  <div class="input-group input-group-sm pull-right" ">
                    <a href="#" class="btn btn-primary btn-sm ad-click-event fa fa-eye">View All</a>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Stock</th>
                    <th></th>
                    <th>Price</th>
                    <th>Shares</th>
                    <th>Market Value</th>
                    <th>Total Profit</th>
                  </tr>
                  @for ($i = 0; $i < count($portfolio); $i++)
                      <tr>
                        <td>{{ $portfolio[$i]['symbol'] }}</td>
                        <td>{{ number_format($portfolio[$i]['change_today'],3) }}</td>
                        <td>${{ $portfolio[$i]['current_price'] }}</td>
                        <td>{{ $portfolio[$i]['qty'] }}</td>
                        <td>${{ $portfolio[$i]['market_value'] }}</td>
                        @if($portfolio[$i]['unrealized_pl'] > 0)
                          <td><span class="label label-success">${{ number_format($portfolio[$i]['unrealized_pl'],2) }}</span></td>
                        @else
                          <td><span class="label label-danger">${{ number_format($portfolio[$i]['unrealized_pl'],2) }}</span></td>
                        @endif
                        </tr>
                  @endfor
                  
                </tbody></table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

          <div class="col-md-6">
            <div class="box" data-vivaldi-spatnav-clickable="1">
              <div class="box-header">
                <h3 class="box-title">Order History</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Stock</th>
                    <th>Order</th>
                    <th></th>
                    <th>Net Price</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                  @for ($i = 0; $i < count($order_history); $i++)
                     <tr>
                     <td>{{ $order_history[$i]['symbol'] }}</td>
                     <td>Market {{ ucwords($order_history[$i]['side'])}}</td>
                    <td>{{ $order_history[$i]['qty'] }} Shares</td>
                    <td>${{ number_format($order_history[$i]['filled_avg_price'],2) }}</td>
                    <td><span class="label label-success">{{ strtoupper($order_history[$i]['status']) }}</span></td>
                    <td>{{ $order_history[$i]['created_at'] }}</td>
                  </tr>
                  @endfor
                </tbody></table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
      </div>
    

@stop