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
        $('#msg').removeClass().empty();
        var section_id=this.id;

        $(this).toggleClass('active');
        $('body').css('cursor', 'wait');

        function bouncerInError(bouncers) {
            var info= bouncers.info;
            var bid= bouncers.info.id;
            var blab= bouncers.info.label;

            $('#mainview').append('<div class="list-group-item d-flex justify-content-between align-items-center" id="bouncer_'+bid+'"><div>'+blab+' ('+info.dsns.host+')</div></div>');
            $('#bouncer_'+bid).append('<div id="divcblist_'+bid+'">');
            $('#divcblist_'+bid).append('<div id="cblist_'+bid+'">');
            $('#cblist_'+bid).html('<i id=status_'+bid+'>Offline</i>');
            $('#status_'+bid).removeClass().addClass("alert alert-warning");
        }

        function bouncerInSuccess(bouncers,section_id) {

            function addOption( hash, res, bouncer ,section_id) {
                if(section_id == 'databases') {
                    $('#tbd_' + hash).append('<tr> <td>'+bouncer.label+'</td> <td>'+res.host+'</td> <td>'+res.port+'</td> <td>'+res.database+'</td> <td>'+res.force_user+'</td> <td>'+res.pool_size+'</td> <td>'+res.reserve_pool+'</td> <td>'+res.pool_mode+'</td> <td>'+res.max_connections+'</td> <td>'+res.current_connections+'</td> </tr>');
                }
                if(section_id == 'stats') {
                    $('#tbd_' + hash).append('<tr> <td>'+res.database+'</td> <td>'+res.total_requests+'</td> <td>'+res.total_received+'</td> <td>'+res.total_sent+'</td> <td>'+res.total_query_time+'</td> <td>'+res.avg_req+'</td> <td>'+res.avg_recv+'</td> <td>'+res.avg_sent+'</td> <td>'+res.avg_query+'</td></tr>');
                }
                if(section_id == 'pools') {
                    $('#tbd_' + hash).append('<tr> <td>'+res.database+'</td> <td>'+res.user+'</td> <td>'+res.cl_active+'</td> <td>'+res.cl_waiting+'</td> <td>'+res.sv_active+'</td> <td>'+res.sv_idle+'</td> <td>'+res.sv_used+'</td> <td>'+res.sv_tested+'</td> <td>'+res.sv_login+'</td> <td>'+res.maxwait+'</td> </tr>');
                }
                if(section_id == 'clients') {
                    $('#tbd_' + hash).append('<tr> <td>'+res.type+'</td> <td>'+res.state+'</td> <td>'+res.user+'</td> <td>'+res.database+'</td> <td>'+res.addr+'</td> <td>'+res.local_addr+'</td> <td>'+res.connect_time+'</td> <td>'+res.request_time+'</td><td>'+res.ptr+'</td> <td>'+res.link+'</td> <td>'+res.remote_pid+'</td> <td>'+res.tls+'</td> </tr>');
                }
                if(section_id == 'servers') {
                    $('#tbd_' + hash).append('<tr> <td>'+res.type+'</td> <td>'+res.state+'</td> <td>'+res.user+'</td> <td>'+res.database+'</td> <td>'+res.addr+'</td> <td>'+res.local_addr+'</td> <td>'+res.connect_time+'</td> <td>'+res.request_time+'</td><td>'+res.ptr+'</td> <td>'+res.link+'</td> <td>'+res.remote_pid+'</td> <td>'+res.tls+'</td> </tr>');
                }
                if(section_id == 'config') {
                    $('#tbd_' + hash).append('<tr> <td>'+res.key+'</td> <td>'+res.value+'</td> <td>'+res.changeable+'</td> </tr>');
                }
                if(section_id == 'current') {
                    $('#tbd_' + hash).append('<tr> <td>'+res.list+'</td> <td>'+res.items+'</td> </tr>');
                }
            }

            var info= bouncers.info;
            var bid= bouncers.info.id;
            var blab= bouncers.info.label;
            var hash = md5(bouncers.info.id); // "2063c1608d6e0baf80249c42e2be5804"

            $('#mainview').append('<div class="list-group-item d-flex justify-content-between align-items-center" id="bouncer_'+bid+'"><div>'+blab+' ('+info.dsns.host+')</div></div>');

            $('#bouncer_'+bid).append('<div id="divcblist_'+bid+'">');
            $('#divcblist_'+bid).append('<div id="cblist_'+bid+'">');
            $('#cblist_'+bid).html('<i id=status_'+bid+'>Online</i>');
            $('#status_'+bid).removeClass().addClass("alert alert-success pull-right");

            $('#cblist_'+bid).append('<h2 class="ui header"><div class="content"><p>'+section_id+'</p></div></h2>');
            $('#cblist_'+bid).append('<div class="" id="widget_'+hash+'" data-name="'+hash+'">');

            $('#widget_'+hash).append('<table id="tset_' + hash + '" class="table table-striped table-bordered">');
            $('#tset_'+hash).append('<thead id="tha_' + hash + '"/>');
            $('#tset_'+hash).append('<tbody id="tbd_' + hash + '"/>');

            if(section_id == 'databases') {
                $('#tha_'+hash).append('<tr> <th>Name</th> <th>Host</th> <th>Port</th> <th>Database</th> <th>Force User</th> <th>Pool Size</th> <th>Reserve Pool</th> <th>Pool Mode</th> <th>Max Connections</th> <th>Current Connections</th></tr>');
            }
            if(section_id == 'stats') {
                $('#tha_'+hash).append('<tr> <th>Database</th> <th>Total requests</th> <th>Total received</th> <th>Total Sent</th> <th>Total query time</th> <th>Avg Req</th> <th>Avg Recv</th> <th>Avg Sent</th> <th>Avg Query</th></tr>');
            }
            if(section_id == 'pools') {
                $('#tha_'+hash).append('<tr> <th>Database</th> <th>User</th> <th>Cl Active</th> <th>Cl Waiting</th> <th>Sv Active</th> <th>Sv Idle</th> <th>Sv Used</th> <th>Sv Tested</th> <th>Sv Login</th> <th>MaxWait</th> </tr>');
            }
            if(section_id == 'clients') {
                $('#tha_'+hash).append('<tr> <th>Type</th> <th>State</th> <th>User</th> <th>Database</th> <th>Source</th> <th>Destination</th> <th>Connect time</th> <th>Request time</th> <th>Ptr</th> <th>Link</th> <th>Remote PID</th> <th>TLS</th> </tr>');
            }
            if(section_id == 'servers') {
                $('#tha_'+hash).append('<tr> <th>Type</th> <th>State</th> <th>User</th> <th>Database</th> <th>Source</th> <th>Destination</th> <th>Connect time</th> <th>Request time</th> <th>Ptr</th> <th>Link</th> <th>Remote PID</th> <th>TLS</th> </tr>');
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
            console.log(data);
            var request_time = new Date().getTime() - start_time;
            if ( console && console.log ) {
                console.log( data );
            }

            $('#mainview').empty().addClass("list-group");

            $.each(data, function(i, bouncers) {
                if(bouncers.error) {
                    bouncerInError(bouncers);
                } else {
                    bouncerInSuccess(bouncers,section_id);
                }
            });
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
