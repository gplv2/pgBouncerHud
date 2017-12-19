/* jslint node: true, maxerr: 50, indent: 4 */

"use strict";

var start_time = 0;
var lhash = "empty";

/*
$(window).resize(function () {
    var canvaswidth=$('#map-wrap').parent().css('width');
    $('#map-wrap').css("width", canvaswidth);
}
*/

var myLocalStorage = {
    set: function (item, value) {
        localStorage.setItem( item, JSON.stringify(value) );
    },
    get: function (item) {
        return JSON.parse( localStorage.getItem(item) );
    }
};

$( document ).ready(function() {
    if (!library) {
        var library = {};
    }

    library.json = {
        syntaxHighlight: function(json) {
            json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                var cls = 'number';
                if (/^"/.test(match)) {
                    if (/:$/.test(match)) {
                        cls = 'key';
                    } else {
                        cls = 'string';
                    }
                } else if (/true|false/.test(match)) {
                    cls = 'boolean';
                } else if (/null/.test(match)) {
                    cls = 'null';
                }
                    return '<span class="' + cls + '">' + match + '</span>';
            });
        }
    };


    $( "#databases, #stats, #pools, #clients, #servers, #config, #current" ).click(function( event ) {
        event.preventDefault();
        $('#bouncerbuttons').children().removeClass('active');

        $(this).addClass('active');

        $('#msg').removeClass().empty();
        var section_id=this.id;

        $(this).toggleClass('active');
        $('body').css('cursor', 'wait');

        function bouncerInError(bouncers) {
            var info= bouncers.info;
            var bid= bouncers.info.id;
            var blab= bouncers.info.label;

            //$('#mainview').append('<div class="ui header">'+blab+' ('+info.dsns.host+')</div>'+'<div class="list-group-item" id="bouncer_'+bid+'"></div>');
            $('#mainview').append('<div class="row-fluid list-group-item" id="bouncer_'+bid+'"/>');
            $('#bouncer_'+bid).append('<div id ="head_'+bid+'" class="myhead"><ol id="breadcrumb_'+bid+'" class="breadcrumb"> <li class="breadcrumb-item active">'+blab + '('+info.dsns.host+')</li> <li class="breadcrumb-item active">'+section_id+'</li></ol>');
            //
            $('#head_'+bid).append('<div class="alert alert-warning pull-right" id="status_'+bid+'">Offline</div>');
        }

        function bouncerInSuccess(bouncers,section_id) {
            var all_cl=0;
            var all_sv=0;

            var all_avg_recv=0;

            var all_tot_recv=0;
            var all_tot_sent=0;

            var all_cur_con=0;

            //console.log(bouncers.results);

            $.each(bouncers.results, function(i, mybouncer) {
                if (mybouncer.cl_active != null) {
                    all_cl+=mybouncer.cl_active;
                }
                    //console.log(mybouncer.sv_active);
                if (mybouncer.sv_active != null && mybouncer.sv_idle != null && mybouncer.sv_used != null && mybouncer.sv_tested != null && mybouncer.sv_login != null ) {
                    all_sv+= mybouncer.sv_active + mybouncer.sv_idle + mybouncer.sv_used + mybouncer.sv_tested + mybouncer.sv_login;
                    //console.log(all_sv);
                }
                if (mybouncer.avg_recv != null) {
                    all_avg_recv+=mybouncer.avg_recv;
                }
                if (mybouncer.total_received != null) {
                    all_tot_recv+=mybouncer.total_received;
                }
                if (mybouncer.current_connections != null) {
                    all_cur_con+=mybouncer.current_connections;
                }
                if (mybouncer.total_sent != null) {
                    all_tot_sent+=mybouncer.total_sent;
                }
            });

            function addOption( hash, res, bouncer ,section_id) {
                // SHOW DATABASES
                if(section_id == 'databases') {
                    var tot_cur_con=Math.round((res.current_connections/all_cur_con)*100);
                    var tot_cur_bar='<div class="progress"> <div class="progress-bar bg-success" role="progressbar" style="width: '+tot_cur_con+'%;" aria-valuenow="'+tot_cur_con+'" aria-valuemin="0" aria-valuemax="100">'+tot_cur_con+'%</div> </div>';
                    //console.log(res);
                    $('#tbd_' + hash).append('<tr> <td>'+bouncer.label+'</td> <td>'+res.host+'</td> <td>'+res.port+'</td> <td>'+res.database+'</td> <td>'+res.force_user+'</td> <td>'+res.pool_size+'</td> <td>'+res.reserve_pool+'</td> <td>'+res.pool_mode+'</td> <td>'+res.max_connections+'</td> <td>'+res.current_connections+'</td> <td>'+tot_cur_bar+'</td> </tr>');
                }
                // SHOW STATS
                if(section_id == 'stats') {

                    var avg_rec= Math.round((res.avg_recv/all_avg_recv)*100);
                    var tot_data_load=Math.round((res.total_received+res.total_sent)/(all_tot_recv+all_tot_sent)*100);

                    var avg_rec_bar='<div class="progress"> <div class="progress-bar bg-success" role="progressbar" style="width: '+avg_rec+'%;" aria-valuenow="'+avg_rec+'" aria-valuemin="0" aria-valuemax="100">'+avg_rec+'%</div> </div>';
                    var tot_data_bar='<div class="progress"> <div class="progress-bar bg-success" role="progressbar" style="width: '+tot_data_load+'%;" aria-valuenow="'+tot_data_load+'" aria-valuemin="0" aria-valuemax="100">'+tot_data_load+'%</div> </div>';
                    $('#tbd_' + hash).append('<tr> <td>'+res.database+'</td> <td>'+res.total_requests+'</td> <td>'+res.total_received+'</td> <td>'+res.total_sent+'</td> <td>'+res.total_query_time+'</td> <td>'+res.avg_req+'</td> <td>'+res.avg_recv+'</td> <td>'+res.avg_sent+'</td> <td>'+res.avg_query+'</td> <td>'+avg_rec_bar+'</td> <td>'+tot_data_bar+'</td> </tr>');
                }
                // SHOW POOLS
                if(section_id == 'pools') {
                    var totcl = res.cl_active + res.cl_waiting;
                    if (res.sv_active != null && res.sv_idle != null && res.sv_used != null && res.sv_tested != null && res.sv_login!= null ) {
                        var totsv = res.sv_active + res.sv_idle + res.sv_used + res.sv_tested + res.sv_login;
                        //console.log(totsv);
                    }

                    var pctcl= Math.round((totcl/all_cl)*100);
                    var pctsv= Math.round((totsv/all_sv)*100);

                    var cl_bar='<div class="progress"> <div class="progress-bar bg-success" role="progressbar" style="width: '+pctcl+'%;" aria-valuenow="'+pctcl+'" aria-valuemin="0" aria-valuemax="100">'+pctcl+'%</div> </div>';
                    var sv_bar='<div class="progress"> <div class="progress-bar bg-success" role="progressbar" style="width: '+pctsv+'%;" aria-valuenow="'+pctsv+'" aria-valuemin="0" aria-valuemax="100">'+pctsv+'%</div> </div>';

                    $('#tbd_' + hash).append('<tr> <td>'+res.database+'</td> <td>'+res.user+'</td> <td>'+res.cl_active+'</td> <td>'+res.cl_waiting+'</td> <td>'+res.sv_active+'</td> <td>'+res.sv_idle+'</td> <td>'+res.sv_used+'</td> <td>'+res.sv_tested+'</td> <td>'+res.sv_login+'</td> <td>'+res.maxwait+'</td> <td>'+ cl_bar +'</td> <td>'+ sv_bar +'</td> </tr>');
                }
                // SHOW CLIENTS
                if(section_id == 'clients') {

                    $('#tbd_' + hash).append('<tr> <td>'+res.type+'</td> <td>'+res.state+'</td> <td>'+res.user+'</td> <td>'+res.database+'</td> <td>'+res.addr+'</td> <td>'+res.local_addr+'</td> <td>'+res.connect_time+'</td> <td>'+res.request_time+'</td><td>'+res.ptr+'</td> <td>'+res.link+'</td> <td>'+res.remote_pid+'</td> <td>'+res.tls+'</td> </tr>');
                }
                // SHOW SERVERS
                if(section_id == 'servers') {
                    $('#tbd_' + hash).append('<tr> <td>'+res.type+'</td> <td>'+res.state+'</td> <td>'+res.user+'</td> <td>'+res.database+'</td> <td>'+res.addr+'</td> <td>'+res.local_addr+'</td> <td>'+res.connect_time+'</td> <td>'+res.request_time+'</td><td>'+res.ptr+'</td> <td>'+res.link+'</td> <td>'+res.remote_pid+'</td> <td>'+res.tls+'</td> </tr>');
                }
                // SHOW CONFIG
                if(section_id == 'config') {
                    $('#tbd_' + hash).append('<tr> <td>'+res.key+'</td> <td>'+res.value+'</td> <td>'+res.changeable+'</td> </tr>');
                }
                // SHOW CURRENT
                if(section_id == 'current') {
                    $('#tbd_' + hash).append('<tr> <td>'+res.list+'</td> <td>'+res.items+'</td> </tr>');
                }
            }

            var info= bouncers.info;
            var bid= bouncers.info.id;
            var blab= bouncers.info.label;
            var hash = md5(bouncers.info.id); // "2063c1608d6e0baf80249c42e2be5804"

            $('#mainview').append('<div class="row-fluid list-group-item" id="bouncer_'+bid+'"/>');

            $('#bouncer_'+bid).append('<div id ="head_'+bid+'" class="myhead"><ol id="breadcrumb_'+bid+'" class="breadcrumb"> <li class="breadcrumb-item"><a href="console#/'+section_id+'">'+blab + '('+info.dsns.host+')</a></li> <li class="breadcrumb-item active">'+section_id+'</li></ol>');

            $('#head_'+bid).append('<div class="alert alert-success pull-right" id="status_'+bid+'">Online</div>');

            $('#bouncer_'+bid).append('<div id="divcblist_'+bid+'">');
            $('#divcblist_'+bid).append('<div id="cblist_'+bid+'">');

            $('#cblist_'+bid).append('<div class="" id="widget_'+hash+'" data-name="'+hash+'">');

            $('#widget_'+hash).append('<table id="tset_' + hash + '" class="table-responsive table-striped table-bordered table-condensed">');
            $('#tset_'+hash).append('<thead id="tha_' + hash + '"/>');
            $('#tset_'+hash).append('<tbody id="tbd_' + hash + '"/>');

            if(section_id == 'databases') {
                $('#tha_'+hash).append('<tr> <th>Name</th> <th>Host</th> <th>Port</th> <th>Database</th> <th>Force User</th> <th>Pool Size</th> <th>Reserve Pool</th> <th>Pool Mode</th> <th>Max Conn</th> <th>Current Conn</th> <th>% Current Conn </th></tr>');
            }
            if(section_id == 'stats') {
                $('#tha_'+hash).append('<tr> <th>Database</th> <th>Total req</th> <th>Tot recv</th> <th>Tot Sent</th> <th>Total qry time</th> <th>Avg Req</th> <th>Avg Recv</th> <th>Avg Sent</th> <th>Avg Query</th> <th>Avg load</th> <<th>Data load</th>/tr>');
            }
            if(section_id == 'pools') {
                $('#tha_'+hash).append('<tr> <th>Database</th> <th>User</th> <th>Cl Active</th> <th>Cl Waiting</th> <th>Sv Active</th> <th>Sv Idle</th> <th>Sv Used</th> <th>Sv Tested</th> <th>Sv Login</th> <th>MaxWait</th> <th>Client load</th> <th>Server load</th> </tr>');
            }
            if(section_id == 'clients') {
                $('#tha_'+hash).append('<tr> <th>Type</th> <th>State</th> <th>User</th> <th>Database</th> <th>Source</th> <th>Destination</th> <th>Connect time</th> <th>Request time</th> <th>Ptr</th> <th>Link</th> <th>PID</th> <th>TLS</th> </tr>');
            }
            if(section_id == 'servers') {
                $('#tha_'+hash).append('<tr> <th>Type</th> <th>State</th> <th>User</th> <th>Database</th> <th>Source</th> <th>Destination</th> <th>Connect time</th> <th>Request time</th> <th>Ptr</th> <th>Link</th> <th>PID</th> <th>TLS</th> </tr>');
            }
            if(section_id == 'config') {
                $('#tha_'+hash).append('<tr> <th>Key</th> <th>Value</th> <th>Changeable</th> </tr>');
            }
            if(section_id == 'current') {
                $('#tha_'+hash).append('<tr> <th>List</th> <th>Items</th> </tr>');
            }

            $.each(bouncers.results, function(i, database) {
                addOption( hash, database, info ,section_id);
            });

            $('#tset_'+hash).DataTable();
        }

        var token = myLocalStorage.get('ngStorage-token');
        //var id = $('#userid').val();
        //var url= "/api/status/databases";
        var url= "/api/status/"+this.id;
        // $('#msg').html('Calling API : <pre class="json">' + library.json.syntaxHighlight(JSON.stringify(token, null, 4)) + '</pre>');
        // $('#apidata').html(JSON.stringify(fdata));

        // Assign handlers immediately after making the request
        $.ajax({
            method: "GET",
            url: url,
            // data: JSON.stringify(fdata),
            cache: false,
            beforeSend: function(xhr, settings) {
                if (token) {
                    xhr.setRequestHeader('Authorization','Bearer ' + token);
                }
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.overrideMimeType( 'application/json' );
                start_time = new Date().getTime();
            }
        }).done(function( data ) {
            $('body').css('cursor', 'default');
            $('#msg').html('Found ' + Object.keys(data).length + ' results');
            $('#msg').removeClass().addClass("alert alert-info");
            //console.log(data);
            var request_time = new Date().getTime() - start_time;
            if ( console && console.log ) {
                console.log( data );
            }

            //$('#mainview').empty().addClass("list-group");
            $('#mainview').empty();

            $.each(data, function(i, bouncers) {
                if(bouncers.error) {
                    bouncerInError(bouncers);
                } else {
                    bouncerInSuccess(bouncers,section_id);
                }
            });
        }).fail(function(data) {
            //console.log(data);
            var request_time = new Date().getTime() - start_time;
            $('#msg').html('Failure API : ' + JSON.stringify(data.responseJSON) + ' (in ' + request_time + 'ms.)');
            $('#msg').removeClass().addClass("alert alert-warning");
        }).always(function() {
            $('body').css('cursor', 'default');
        });
    });


    $( "#allreqbutton" ).click(function( event ) {
            event.preventDefault();

            $('body').css('cursor', 'wait');

            // Get some values from elements on the page:
            //var mt = $("#mediatype").val();
            var mc = $("#mediacount").val();
            var itid = $("#itemid").val();

            var token = myLocalStorage.get('ngStorage-token');

            var id = $('#userid').val();
            //var url= "/api/users/"+ id +"/items";

            var url= "/api/batch/all";

            var fdata = {};
            /* Gather form data */
            fdata['request_id'] = $('#requestid').val()
            fdata['itemid'] = itid;
            fdata['quantity'] = parseInt(mc);

            $('#msg').html('Calling API : <pre class="json">' + library.json.syntaxHighlight(JSON.stringify(fdata, null, 4)) + '</pre>');

            // Assign handlers immediately after making the request,
            $.ajax({
                method: "POST",
                url: url,
                data: JSON.stringify(fdata),
                cache: false,
                beforeSend: function(xhr, settings) {
                    if (token) {
                        xhr.setRequestHeader('Authorization','Bearer ' + token);
                    }
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.overrideMimeType( 'application/json' );
                    start_time = new Date().getTime();
                }
            })
            .done(function( data ) {
                var request_time = new Date().getTime() - start_time;
                //if ( console && console.log ) {
                    //console.log( "success" );
                    //console.log( data );
                //}

                $('#msg').html('<p>Success API : ' + JSON.stringify(data) + ' (in ' + request_time + 'ms.)</p>');
                $('#msg > p:last-child').removeClass().addClass("alert alert-success");
            })
            .fail(function( data ) {
                var request_time = new Date().getTime() - start_time;
                $('#msg').html('<div>Failure API : ' + JSON.stringify(data.responseJSON) + ' (in ' + request_time + 'ms.) </div>');
                $('#msg > div:last-child').removeClass().addClass("alert alert-warning");
                //if ( console && console.log ) {
                    //console.log(data);
                    //console.log( "error" );
                //}
                return false;
            })
            .always(function() {
                $('body').css('cursor', 'default');
                //$('#msg').append('<p>Status API : Request finished<p>');
                //if ( console && console.log ) {
                    //console.log( "finished" );
                //}
            });
      });


      function reviver2(key, val) {
        if ( key === 'quantity' ) {
            return parseInt(val);
        } else if ( typeof val === 'string' ) {
            // restore ' (undo JSON_HEX_APOS)
            val = val.replace(/\u0027/g, "'");
            // return val.replace(/\s+/g, ' '); // remove extra spaces
            return val;
        } else {
            return val; // return unchanged
        }
     }

});
