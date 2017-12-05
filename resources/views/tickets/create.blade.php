
@extends('layouts.app')

@section('title', 'Support - Open Ticket')

@section('bodydef')
<body ng-app="app">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-newspaper-o"> Open New Ticket</i>
                </div>

                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/newticket') }}" id="ticketform">
                        {!! csrf_field() !!}
                        <div id="response"></div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gsm') ? ' has-error' : '' }}">
                            <label for="gsm" class="col-md-4 control-label">GSM</label>

                            <div class="col-md-6">
                                <input id="gsm" type="text" class="form-control" name="gsm" value="{{ old('gsm') }}">

                                @if ($errors->has('gsm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gsm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea rows="10" id="description" class="form-control" name="description"></textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="ticketbutton" class="btn btn-primary pull-left" tabindex="1">
                                    <i class="fa fa-btn fa-ticket"></i> Open Ticket
                                </button>
				                <button id="ticketreset" type="reset" class="btn btn-primary pull-right" tabindex="2">
					                <i class="fa fa-btn fa-refresh"></i> Reset
				                </button>
                            </div>
                        </div>
                    </form>
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
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Scripts -->
<!-- {!! Html::script('js/start.js') !!} -->
{!! Html::script('js/md5.min.js') !!}
@endsection
