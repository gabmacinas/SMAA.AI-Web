@extends('adminlte::page')

@section('title', 'SMAA.AI - Prediction')

@section('content_header')
<div class="row">
  <div class="col-md-6">
    <div class="box" data-vivaldi-spatnav-clickable="1">
            <div class="box-header">
              <h3 class="box-title">Predict Stocks</h3>
            </div>
            <div class="box-body">
              <div class="input-group margin">
                <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat">Search</button>
                    </span>
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.box-body -->
          </div>
  </div>
  {{-- <div class="col-md-6">
      <div class="box" data-vivaldi-spatnav-clickable="1">
              <div class="box-header">
                <h3 class="box-title">5 Days Prediction</h3>
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
                  <tr>
                    <td>MSFT</td>
                    <td>Market BUY</td>
                    <td>100 Shares</td>
                    <td>$107.00</td>
                    <td><span class="label label-success">FILLED</span></td>
                    <td>Feb 6, '19 07:28 AM</td>
                  </tr>
                  <tr>
                    <td>AAPL</td>
                    <td>Market BUY</td>
                    <td>100 Shares</td>
                    <td>$174.60</td>
                    <td><span class="label label-success">FILLED</span></td>
                    <td>Feb 6, '19 07:26 AM</td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.box-body -->
            </div>
  </div> --}}

</div>
<div class="row">
<div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Area Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                {!! $chartjs->render() !!}
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
                        <td><span class="label label-success">${{ number_format($portfolio[$i]['unrealized_pl'],2) }}</span></td>
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
