@extends('layouts.app')

@section('title', 'Console - about')

@section('page-style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/openlayers/2.12/theme/default/style.css" media="all" /> -->
<style>
      .panel-body {
         padding: 0px;
      }
      .panel {
         margin-bottom: 5px;
         margin-top: 5px;
         padding: 8px;
      }
      .form-group {
         padding: 8px;
      }
</style>
@stop

@section('bodydef')
<body ng-app="app">
@endsection

@section('content')

<div class="container-fluid">
  <div class="row-fluid">
    <!--Sidebar content-->
    <div class="col-sm-3 col-md-3 sidebar sidebar-left pull-left">
      <!--Injected angular content-->
            <div class="panel panel-default" ng-view=""></div>
    </div>
    <div class="col-sm-9 col-md-9 sidebar sidebar-left pull-right">
      <!--Body content-->
            <div class="panel panel-default">
                <div class="panel-heading">
                 Welcome to the pgBouncerHud api console
               </div>
                <div class="panel-body">
		This console is just a consumer of the API underneath.  It's a sample implementation , you need to take care of authentication.
                </div>
         </div>
    </div>
  </div>
</div>

@endsection
@section('page-bottom-script')
<!-- Scripts -->
<!-- Angular app -->
<script src="/js/app.js"></script>
<script src="/js/controllers.js"></script>
<script src="/js/services.js"></script>
<!-- <script src="/js/jquery.fileinput.js"></script> -->
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/start.js"></script>
<script src="/js/md5.min.js"></script>
<!-- Scripts -->
<!-- {!! Html::script('js/start.js') !!} -->
@endsection
