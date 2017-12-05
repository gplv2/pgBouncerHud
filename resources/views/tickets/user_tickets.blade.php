@extends('layouts.app')

@section('title', 'Support - Open Tickets')

@section('bodydef')
<body ng-app="app">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-ticket"> My Tickets</i>
                </div>

                <div class="panel-body">
                        <table class="table" id="tickettable">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>
                            <tbody id="tickets">
                            </tbody>
                        </table>
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
