@extends('layouts.app')

@section('title', 'Console - about')

@section('page-style')
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
    <div class="col-sm-8 col-md-8 sidebar sidebar-right pull-left">
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

<!-- Angular app -->
<script src="/js/app.js"></script>
<script src="/js/controllers.js"></script>
<script src="/js/services.js"></script>
<script src="/js/start.js"></script>
<script src="/js/md5.min.js"></script>

<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Scripts -->
<!-- {!! Html::script('js/start.js') !!} -->
@endsection
