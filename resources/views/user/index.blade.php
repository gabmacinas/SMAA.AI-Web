@extends('adminlte::page')

@section('title', $Title)

@section('content_header')
      <h1>
        SMAA.AI
        <small></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>{{$Title}}</a></li>
        {{-- <li class="active">Widgets</li> --}}
      </ol>
@stop

@section('content')
   <div class="row">
       <div class="col-md-6">
           <div class="box box-info" data-vivaldi-spatnav-clickable="1">
            <div class="box-header with-border">
              <h3 class="box-title">API Settings</h3>
            </div>
            <form class="form-horizontal">
              <div class="box-body">
                
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
            </form>
          </div>
       </div>
   </div>

@stop