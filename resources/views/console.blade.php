@extends('layouts.app')

@section('title', 'Console - overview')

@section('page-style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/openlayers/2.12/theme/default/style.css" media="all" /> -->
<style>
.ol-mouse-position {
    top: auto;
    bottom: 2em;
}
.ol-overviewmap {
    bottom: 2em;
}
.ol-zoomslider {
    top: 7em;
}
.ol-rotate {
    top: 2.5em;
}
.draw-point {
    right: 3em;
    top: .5em;
}

.map{
    /* width: 1000px;
    margin: 5px;
    height: 468px; */
    width: 98%;
    height: 98%;
    position: block;
}

.content > p:first-letter {
    text-transform:capitalize;
}

.list-group {
    margin-bottom: 7px;
}

#flash {
    padding-bottom: 1em;
}

.myhead {
    /*display:inline-block; */
    display: flex;
}

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

.form-check-label {
    margin-right: 5em;
    margin-bottom: 0;
    cursor: pointer;
}

.form-check {
    position: relative;
    display: block;
    margin-bottom: .75rem;
}

.form-check-input {
    position: absolute;
    margin-top: .25rem;
    margin-left: -1.25rem;
    margin-right: 14px;
}

.form-check-input:only-child {
    margin-right: 10px;
    position: static;
}

.form-check.disabled .form-check-label {
    color: #818a91;
    cursor: not-allowed;
}

#map-wrap {
    min-height: 500px;

}

#cblist > input {
    margin:3px;
    clear:left;
}

#cblist > label,input {
    float:left;
}

.boxsizingBorder {
    -webkit-box-sizing: border-box;
       -moz-box-sizing: border-box;
            box-sizing: border-box;
}

fieldset {
    display: block;
    -webkit-margin-start: 2px;
    -webkit-margin-end: 2px;
    -webkit-padding-before: 0.35em;
    -webkit-padding-start: 0.75em;
    -webkit-padding-end: 0.75em;
    -webkit-padding-after: 0.625em;
    border-image-source: initial;
    border-image-slice: initial;
    border-image-width: initial;
    border-image-outset: initial;
    border-image-repeat: initial;
    min-width: -webkit-min-content;
    border-width: 1px;
    border-style: groove;
    border-color: threedface;
}

#cb_none {
    margin: 15px;
    padding: 18px;
}

.break-word {
    word-wrap: break-word;
}

/* Style json with CSS + Javascript

.json {
   background-color: ghostwhite;
   border: 1px solid silver;
   padding: 10px 20px;
   margin: 20px;
}
*/

.json-key {
   color: brown;
}

.json-value {
   color: navy;
}

.json-string {
   color: olive;
}

.json {outline: 1px solid #ccc; padding: 5px; margin: 5px; }
.string { color: green; }
.number { color: darkorange; }
.boolean { color: blue; }
.null { color: magenta; }
.key { color: red; }

#feedback { font-size: 1.4em; }
#selectable .ui-selecting { background: #FECA40; text-align: center; }
#selectable .ui-selected { background: #F39814; color: white; }
#selectable { list-style-type: none; margin: 0; padding: 0; width: '100%'; }
#selectable li { margin: 3px; padding: 1px; float: left; width: 180px; height: 160px; font-size: 1em; text-align: center; }
#selectable li p { margin: 3px; padding: 1px; font-size: 0.71em; text-align: center; color: gray; }
#selectable div { padding: 1px; font-size: 0.61em; text-align: center; color: gray; }

#mainscreen { list-style-type: none; margin: 0; padding: 0; background: #FECC40; color: black; margin: 3px; padding: 1px; float: left; width: 400px; height: 325px; border: 1px; font-size: 2em; text-align: center; }
#mainscreen li { padding: 1px; float: left; font-size: 1em; text-align: center; background: #FECC40; }
#mainscreen li p { padding: 1px; font-size: 0.75em; text-align: center; color: gray; }
#mainscreen div { padding: 1px; margin-top: 5px ; font-size: 0.65em; text-align: center; color: gray; }

.vertical-align {
    display: flex;
    align-items: center;
}

.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
.btn-group {
    padding-top: 10px;
    padding-bottom: 10px;
}

.input-file { position: relative; margin: 60px 60px 0 } /* Remove margin, it is just for stackoverflow viewing */
.input-file .input-group-addon { border: 0px; padding: 0px; }
.input-file .input-group-addon .btn { border-radius: 0 4px 4px 0 }
.input-file .input-group-addon input { cursor: pointer; position:absolute; width: 72px; z-index:2;top:0;right:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0; background-color:transparent; color:transparent; }
</style>
@stop

@section('page-script')
<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/openlayers/2.12/OpenLayers.js"></script>-->
@stop

@section('bodydef')
<body ng-app="app">
@endsection

@section('content')

<div class="container-fluid">
  <div class="row-fluid">
    <!--Sidebar content-->
    <div class="col-sm-2 col-md-2 sidebar sidebar-left pull-left">
      <!--Injected angular content-->
            <div class="panel panel-default" ng-view=""></div>
    <!-- Options -->
    <div class="panel panel-default">
        <div class="panel-heading" data-toggle="collapse" data-target="#generalopts">
            Options
        </div>
        <div id="generalopts" class="panel-body collapse">
            <form id="genform" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="userid" class="col-md-0 control-label">UserID</label>

                    <div class="col-md-6">
                        <input type="number" class="form-control" id="userid" placeholder="Numeric id : 1234" value="12345">
                    </div>
                </div>
                <div class="form-group">
                    <label for="requestid" class="col-md-0 control-label">RequestID</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" id="requestid" placeholder="Your request ref." value="12345">
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>

    <div class="col-sm-10 col-md-10 sidebar sidebar-left pull-right">
      <!--Body content-->
            <div class="panel panel-default">
                <div class="panel-heading">
                  Console
                </div>
                <!-- <div class="panel-body" id="map-wrap"> -->
                    <div class="panel-body pusher">
                        <div class="ui main container-fluid">
                            <div class="row-fluid" >
                            <div id="bouncerbuttons" class="btn-group" role="group" aria-label="Bouncer function buttons">
                                <button type="button" id="databases" class="btn btn-default btn-lg" href="#/databases">Databases</button>
                                <button type="button" id="stats" class="btn btn-default btn-lg" href="#/stats">Stats</button>
                                <button type="button" id="pools" class="btn btn-default btn-lg" href="#/pools">Pools</button>
                                <button type="button" id="clients" class="btn btn-default btn-lg" href="#/clients">Clients</button>
                                <button type="button" id="servers" class="btn btn-default btn-lg" href="#/servers">Servers</button>
                                <button type="button" id="config" class="btn btn-default btn-lg" href="#/config">Config</button>
                                <button type="button" id="current" class="btn btn-default btn-lg" href="#/current">Current</button>
                            </div>
                            <div id="mainview" class="ui pointing menu">
                            </div>
                        </div>
                    <div class="panel-footer">
                        <div id="msg" class="break-word notice info"></div>
                    </div>
                </div>
            <!-- </div> -->
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
<!-- <script src="/js/jquery.fileinput.js"></script> -->
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="/js/start.js"></script>
<script src="/js/md5.min.js"></script>
<!-- Scripts -->
@endsection
