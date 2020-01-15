@extends('adminlte::page')

@section('title', $title)

@section('content_header')
      <h1>
        Trading
        <small></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>{{$title}}</a></li>
        {{-- <li class="active">Widgets</li> --}}
      </ol>
@stop

@section('content')
  <div class="row">
      <div class="col-sm-12">
          <div class="box box-danger">
            {{Form::open(array('action' => 'TradesController@store'))}}
            <div class="box-header with-border">
              <h3 class="box-title">Trade Now</h3>
            </div>
            <div class="box-body">
              <div class="row">
                
                <div class="col-xs-3">
                  <select name="b_method" class="form-control">
                    <option>BUY</option>
                    <option>SELL</option>
                  </select>
                </div>
                <div class="col-xs-4">
                  <input name="ticker" type="text" class="form-control" placeholder="Ticker">
                </div>
                <div class="col-xs-4">
                  <input name="shares" type="text" class="form-control" placeholder="Shares">
                </div>
              </div>
               
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Trade</button>
              </div>
              {{Form::close()}}
          </div>
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
                        <td>{{ number_format($portfolio[$i]['change_today'],2) }}</td>
                        <td>${{ $portfolio[$i]['current_price'] }}</td>
                        <td>{{ $portfolio[$i]['qty'] }}</td>
                        <td>${{ $portfolio[$i]['market_value'] }}</td>
                        @if($portfolio[$i]['unrealized_pl'] > 0)
                          <td><span class="label label-success">${{ number_format($portfolio[$i]['unrealized_pl'],2) }}</span></td>
                          </tr>
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
                    <td>
                      @if($order_history[$i]['status'] == 'new')
                        <span class="label label-warning">{{ strtoupper($order_history[$i]['status']) }}</span>
                      @elseif($order_history[$i]['status'] == 'partially_filled')
                          <span class="label label-warning">{{ strtoupper($order_history[$i]['status']) }}</span>
                      @elseif($order_history[$i]['status'] == 'done_for_day')
                          <span class="label label-warning">{{ strtoupper($order_history[$i]['status']) }}</span>
                      @elseif($order_history[$i]['status'] == 'filled')
                          <span class="label label-success">{{ strtoupper($order_history[$i]['status']) }}</span>
                      @else
                          <span class="label label-danger">{{ strtoupper($order_history[$i]['status']) }}</span>
                      @endif
                      
                    </td>
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