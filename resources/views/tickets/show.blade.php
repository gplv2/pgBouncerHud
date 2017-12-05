
@extends('layouts.app')

@section('title', 'Support - View Tickets')

@section('bodydef')
<body ng-app="app">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-newspaper-o"> View Ticket: </span>
                    <span class="label label-success">#{{ $ticket->ticket_id }}</span> - {{ $ticket->title }}
                </div>
                <div class="panel-body">
                    <div class="ticket-info">
                        <p><strong>Created :</strong> {{ $ticket->created_at->diffForHumans() }} - <strong>Category:</strong> {{ $category->name }} </p>
                        @if ($ticket->status === 'Open')
                            Status: <span class="label label-success">{{ $ticket->status }}</span>
                        @else
                            Status: <span class="label label-danger">{{ $ticket->status }}</span>
                        @endif
                    </div>
                </div>
                <div class="panel-footer">
                    <p><strong>Description:</strong></p>
                    <p style="background-color: #D3D3D3; color: black; overflow: auto;" class="clear_fix">{{ $ticket->description }}</p>
                </div>
            </div> 
        </div> 
   </div> 
<!--
    <div class="row-fluid">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add comment</div>
                <div class="panel-body comment-form">
                    <form action="{{ url('comment') }}" method="POST" role="form" class="form-horizontal">
                        {!! csrf_field() !!}

                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <textarea rows="10" id="comment" class="form-control" name="comment">Disabled</textarea>

                            @if ($errors->has('comment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
                            @endif
                        </div>
                    </form>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
-->
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
