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


    $( "#databases" ).click(function( event ) {
            event.preventDefault();

            $(this).toggleClass('active');
            $('body').css('cursor', 'wait');

            // var mt = $("#soemid").val();

            var token = myLocalStorage.get('ngStorage-token');

            //var id = $('#userid').val();

            //var url= "/api/status/"+ id +"/databases";
            var url= "/api/status/databases";
            // $('#msg').html('Calling API : <pre class="json">' + library.json.syntaxHighlight(JSON.stringify(token, null, 4)) + '</pre>');

            // Filing out the json freeform text field
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
            })
            .done(function( data ) {
                $('body').css('cursor', 'default');
                var request_time = new Date().getTime() - start_time;
                if ( console && console.log ) {
                    //console.log( data );
                }

                $('#mainview').empty();

                function addOption( hash, res, bouncer ) {
                    //console.log(bouncer);
                    //var uniqueid=Object.keys(bouncers)[0];
                    //var label=bouncers[uniqueid];

//                 <tr> <td>db1</td> <td></td> <td>6101</td> <td>d22mpo16g6ti4b</td> <td></td> <td>1</td> <td>1</td> <td></td> <td>100</td> <td>1</td> </tr>
 //                <tr> <td>pgbouncer</td> <td></td> <td>6001</td> <td>pgbouncer</td> <td>pgbouncer</td> <td>2</td> <td>0</td> <td>statement</td> <td>100</td> <td>0</td> </tr>

                    // $('#widget_'+hash).append('<h3>'+bouncers+'</>');

                    $('#tbd_' + hash).append('<tr> <td>'+bouncer.label+'</td> <td>'+res.host+'</td> <td>'+res.port+'</td> <td>'+res.database+'</td> <td>'+res.force_user+'</td> <td>'+res.pool_size+'</td> <td>'+res.reserve_pool+'</td> <td>'+res.pool_mode+'</td> <td>'+res.max_connections+'</td> <td>'+res.current_connections+'</td> </tr>');
                }

                //console.log(data);

                $.each(data, function(i, bouncers) {
                    var hash = md5(bouncers.info.id); // "2063c1608d6e0baf80249c42e2be5804"
                    var bid= bouncers.info.id;
                    var blab= bouncers.info.label;
                    var info= bouncers.info;
                    //console.log( bouncers.info );
                    //console.log( bouncers.results );

                    $('#mainview').append('<div id="bouncer_'+bid+'">'+blab+'</div>');
                    $('#bouncer_'+bid).append('<div id="divcblist_'+bid+'">');
                    $('#divcblist_'+bid).append('<div id="cblist_'+bid+'">');

                    $('#cblist_'+bid).append('<h4 class="ui header"><div class="content">Poolers</div></h4>');
                    $('#cblist_'+bid).append('<div class="" id="widget_'+hash+'" data-name="'+hash+'">');

                    $('#widget_'+hash).append('<table id="tset_' + hash + '" class="ui compact table">');
                    $('#tset_'+hash).append('<thead id="tha_' + hash + '"/>');
                    $('#tset_'+hash).append('<tbody id="tbd_' + hash + '"/>');
                    $('#tha_'+hash).append('<tr> <th>Name</th> <th>Host</th> <th>Port</th> <th>Database</th> <th>Force User</th> <th>Pool Size</th> <th>Reserve Pool</th> <th>Pool Mode</th> <th>Max Connections</th> <th>Current Connections</th></tr>');

                    $.each(bouncers.results, function(i, database) {
                        addOption( hash, database, info );
                    });
                });
            });
      });

    $( "#stats" ).click(function( event ) {
            event.preventDefault();

            $(this).toggleClass('active');
            $('body').css('cursor', 'wait');

            // var mt = $("#soemid").val();

            var token = myLocalStorage.get('ngStorage-token');

            //var id = $('#userid').val();

            //var url= "/api/status/"+ id +"/databases";
            var url= "/api/status/stats";
            // $('#msg').html('Calling API : <pre class="json">' + library.json.syntaxHighlight(JSON.stringify(token, null, 4)) + '</pre>');

            // Filing out the json freeform text field
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
            })
            .done(function( data ) {
                $('body').css('cursor', 'default');
                var request_time = new Date().getTime() - start_time;
                if ( console && console.log ) {
                    console.log( data );
                }

                $('#mainview').empty();

                function addOption( hash, res, bouncer ) {
                    //console.log(bouncer);
                    //var uniqueid=Object.keys(bouncers)[0];
                    //var label=bouncers[uniqueid];

//                 <tr> <td>db1</td> <td></td> <td>6101</td> <td>d22mpo16g6ti4b</td> <td></td> <td>1</td> <td>1</td> <td></td> <td>100</td> <td>1</td> </tr>
 //                <tr> <td>pgbouncer</td> <td></td> <td>6001</td> <td>pgbouncer</td> <td>pgbouncer</td> <td>2</td> <td>0</td> <td>statement</td> <td>100</td> <td>0</td> </tr>

                    // $('#widget_'+hash).append('<h3>'+bouncers+'</>');

                    $('#tbd_' + hash).append('<tr> <td>'+res.database+'</td> <td>'+res.total_requests+'</td> <td>'+res.total_received+'</td> <td>'+res.total_sent+'</td> <td>'+res.total_query_time+'</td> <td>'+res.avg_req+'</td> <td>'+res.avg_recv+'</td> <td>'+res.avg_sent+'</td> <td>'+res.avg_query+'</td></tr>');
                }

                //console.log(data);

                $.each(data, function(i, bouncers) {
                    var hash = md5(bouncers.info.id); // "2063c1608d6e0baf80249c42e2be5804"
                    var bid= bouncers.info.id;
                    var blab= bouncers.info.label;
                    var info= bouncers.info;
                    //console.log( bouncers.info );
                    //console.log( bouncers.results );

                    $('#mainview').append('<div id="bouncer_'+bid+'">'+blab+'</div>');
                    $('#bouncer_'+bid).append('<div id="divcblist_'+bid+'">');
                    $('#divcblist_'+bid).append('<div id="cblist_'+bid+'">');

                    $('#cblist_'+bid).append('<h4 class="ui header"><div class="content">Poolers</div></h4>');
                    $('#cblist_'+bid).append('<div class="" id="widget_'+hash+'" data-name="'+hash+'">');

                    $('#widget_'+hash).append('<table id="tset_' + hash + '" class="ui compact table">');
                    $('#tset_'+hash).append('<thead id="tha_' + hash + '"/>');
                    $('#tset_'+hash).append('<tbody id="tbd_' + hash + '"/>');
                    $('#tha_'+hash).append('<tr> <th>Database</th> <th>Total requests</th> <th>Total received</th> <th>Total Sent</th> <th>Total query time</th> <th>Avg Req</th> <th>Avg Recv</th> <th>Avg Sent</th> <th>Avg Query</th></tr>');

                    $.each(bouncers.results, function(i, database) {
                        addOption( hash, database, info );
                    });
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

     $( "#codebutton" ).click(function( event ) {
            event.preventDefault();

            $('body').css('cursor', 'wait');

            var token = myLocalStorage.get('ngStorage-token');

            var url= "/api/movie_wizard/recommendations";

            var fdata = new Object();

            try {
                var str=$('#apidata').val();
                fdata = JSON.parse(str, reviver2);
                if ( console && console.log ) {
                    console.log(fdata);
                }
            } catch(e){
                $('#msg').html('<p>Error API : JSON does not pass validation,  check syntax of the data in the JSON text field');
                $('#msg').html(e);
                $('body').css('cursor', 'default');
                return false;
            }

            var size = fdata.length;
            if (size == 0) {
                $('#msg').html('<p>Error API : Please enter valid data in the JSON text field');
                $('body').css('cursor', 'default');
                return false;
            }

            //fdata['token'] = token;

            $('#msg').html('<p>Calling API : ' + JSON.stringify(fdata) + '</p>');

            // Assign handlers immediately after making the request,
            $.ajax({
                method: "POST",
                url: url,
                data: JSON.stringify(fdata),
                cache: false,
                beforeSend: function(xhr, settings) {
                    xhr.setRequestHeader('Authorization','Bearer ' + token);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.overrideMimeType( 'application/json' );
                }
            })
            .done(function( data ) {
                if ( console && console.log ) {
                    //console.log( "Sample of data:", data.slice( 0, 100 ) );
                    //console.log( "success" );
                    //console.log( data );
                }

                $('#map-wrap').append('<form id="myform">');

                $('#myform').append('<div id="divcblist">');
                $('#divcblist').append('<fieldset id="cblist">');

                var container = $('#cblist');
                var inputs = container.find('input');
                var id = inputs.length+1;

                // Iterate over all existing checkboxes remove from suggestion list when missing
                var fdata = {};

                $('#cblist input[type=checkbox]').each(function (i,item) {
                    // console.log(this.value);
                    var md5id = $(this).attr('id');

                    var found = false;
                    $.each(data.recommendations, function(i, recommendation) {
                        var hash = md5(recommendation);
                        if ( 'cb'+hash == md5id) {
                            found = true;
                            return found;
                        }
                    });
                    if (!found) {
                        $(this).parent().remove();
                    }
                });
/*
                //if ($(this).is(":checked"))
*/

                // Iterate over presented recommendations and add to list when missing
                $.each(data.recommendations, function(i, recommendation) {
                    var hash = md5(recommendation);

                    var $myDiv = $('#'+ 'cb' + hash);
                    if (! $myDiv.length){
                        //console.log( recommendation );
                        $('<input />', { type: 'checkbox', id: 'cb'+hash, value: recommendation }).appendTo(container);
                        $('<label />', { 'for': 'cb'+hash, text: recommendation }).appendTo(container);
                        id++;
                    }
                });

                // $('#myform').append('</fieldset></div>');
                // $('#map-wrap').append('</form');

                $('#msg').html('<p>Success API : ' + JSON.stringify(data) + '</p>');
            })
            .fail(function( data ) {
                if ( console && console.log ) {
                    console.log(data);
                    console.log( "error" );
                }
                $('#msg').append('<p>Failure API : ' + JSON.stringify(data.responseJSON) + '</p>');
                return false;
            })
            .always(function() {
                $('body').css('cursor', 'default');
                $('#msg').append('<p>Status API : Request finished<p>');
                if ( console && console.log ) {
                    //console.log( "finished" );
                }
            });
            // return true;
      });

    $( "#ticketreset" ).click(function( event ) {
        lhash = "empty";
        $('#response').empty().removeClass();
        $('body').css('cursor', 'default');
    });

    $( "#resetbutton" ).click(function( event ) {
            event.preventDefault();
            $('#msg').html('<p>Resetting session</p>');
            $('body').css('cursor', 'wait');
            $('#map-wrap').empty();

            $('#apidata').empty();
            $('body').css('cursor', 'default');
    });

    $( "#ticketbutton" ).click(function( event ) {
            event.preventDefault();

            $('body').css('cursor', 'wait');

            // Get some values from elements on the page:
            var mt = $("#mediatype").val();
            var mc = $("#mediacount").val();

            var token = myLocalStorage.get('ngStorage-token');

            var url= "/api/tickets";

            // Get history data

            var fdata = {};

            /* Gather form data */

            fdata['_token']   = $('input:hidden[name=_token]').val();
            fdata['title']    = $('#title').val();
            //fdata['category'] = $('#category').val();
            //fdata['priority'] = $('#priority').val();
            fdata['email'] = $('#email').val();
            fdata['gsm'] = $('#gsm').val();
            fdata['description']  = $('#description').val();
            // $('#msg').html('Calling API : <pre class="json">' + library.json.syntaxHighlight(JSON.stringify(fdata, null, 4)) + '</pre>');

            var fhash = md5(fdata); //e.g. "2063c1608d6e0baf80249c42e2be5804"

            if ( fhash == lhash ) {
                $('#response').html("Identical Ticket has already been opened.");
                $('#response').removeClass().addClass("alert alert-warning");
                $('body').css('cursor', 'default');
                $("#ticketbutton").effect( 'pulsate', options, 500);
                return false;
            }

            var options = {};

            // Assign handlers immediately after making the request,
            $.ajax({
                method: "POST",
                url: url,
                data: fdata,
                cache: false,
                beforeSend: function(xhr, settings) {

                    if (token) {
                        xhr.setRequestHeader('Authorization','Bearer ' + token);
                    }
                    // xhr.setRequestHeader('Content-Type', 'application/json');
		            // Content-Type:application/x-www-form-urlencoded
                    // xhr.overrideMimeType( 'application/json' );
                    start_time = new Date().getTime();
                }
            })
            .done(function( data ) {
                $('#ticketform input[type=text], textarea').each(function (i,item) {
                    //console.log(this);
                    $(this).parent().parent().removeClass("has-error");
                    $('span' ).remove();
                });

                $('#response').html(data.message + ' #' + data.ticket_id);
                $('#response').removeClass().addClass("alert alert-success");

                //$('#msg').append('<p>Success API : ' + JSON.stringify(data) + ' (in ' + request_time + 'ms.)</p>');
                //$('#msg > p:last-child').removeClass().addClass("alert alert-success");
                //return true;
                // register the hash
                lhash = fhash;

                return true;
            })
            .fail(function( data ) {
                var request_time = new Date().getTime() - start_time;

                var parsed = data.responseJSON;

                $('#ticketform input[type=text], textarea').each(function (i,item) {
                    //console.log(this);
                    $(this).parent().parent().removeClass("has-error");
                    $('span' ).remove();
                });

                //$('#ticketform input[type=text]').each(function (i,item)
                $(Object.keys(parsed)).each(function (i,key) {
                    var spanner='<span class="help-block"><strong>' + parsed[key][0] + '</strong></span>';
                    $('#'+key).after(spanner);
                    $('#'+key).parent().parent().addClass("has-error");
                });

            })
            .always(function() {
                $('body').css('cursor', 'default');
                $("#ticketbutton").effect( 'pulsate', options, 500);

                return true;
            });
      });

    $( "#allticketsbutton" ).click(function( event ) {
            event.preventDefault();

            $('body').css('cursor', 'wait');

            // Get some values from elements on the page:
            var mt = $("#mediatype").val();
            var mc = $("#mediacount").val();

            var token = myLocalStorage.get('ngStorage-token');

            var url= "/api/tickets";

            // Get history data

            var fdata = {};

            /* Gather form data */

            fdata['_token']   = $('input:hidden[name=_token]').val();
            fdata['title']    = $('#title').val();
            //fdata['category'] = $('#category').val();
            //fdata['priority'] = $('#priority').val();
            fdata['email'] = $('#email').val();
            fdata['gsm'] = $('#gsm').val();
            fdata['description']  = $('#description').val();
            // $('#msg').html('Calling API : <pre class="json">' + library.json.syntaxHighlight(JSON.stringify(fdata, null, 4)) + '</pre>');

            var fhash = md5(fdata); //e.g. "2063c1608d6e0baf80249c42e2be5804"
            //if ( console && console.log ) {
                //console.log(fhash);
            //}

            if ( fhash == lhash ) {
                $('#response').html("Identical Ticket has already been opened.");
                $('#response').removeClass().addClass("alert alert-warning");
                $('body').css('cursor', 'default');
                $("#ticketbutton").effect( 'pulsate', options, 500);
                return false;
            }

            var options = {};

            // Assign handlers immediately after making the request,
            $.ajax({
                method: "POST",
                url: url,
                data: fdata,
                cache: false,
                beforeSend: function(xhr, settings) {

                    if (token) {
                        xhr.setRequestHeader('Authorization','Bearer ' + token);
                    }
                    // xhr.setRequestHeader('Content-Type', 'application/json');
		            // Content-Type:application/x-www-form-urlencoded
                    // xhr.overrideMimeType( 'application/json' );
                    start_time = new Date().getTime();
                }
            })
            .done(function( data ) {

                //if ( console && console.log ) {
                //    console.log(data);
                //    //return true;
		        //}

                $('#ticketform input[type=text], textarea').each(function (i,item) {
                    //console.log(this);
                    $(this).parent().parent().removeClass("has-error");
                    $('span' ).remove();
                });

                $('#response').html(data.message + ' #' + data.ticket_id);
                $('#response').removeClass().addClass("alert alert-success");

                //$('#msg').append('<p>Success API : ' + JSON.stringify(data) + ' (in ' + request_time + 'ms.)</p>');
                //$('#msg > p:last-child').removeClass().addClass("alert alert-success");
                //return true;
                // register the hash
                lhash = fhash;

                return true;
            })
            .fail(function( data ) {
                var request_time = new Date().getTime() - start_time;
                //$('#msg').append('<div>Failure API : ' + JSON.stringify(data.responseJSON) + ' (in ' + request_time + 'ms.) </div>');
                //$('#msg > div:last-child').removeClass().addClass("alert alert-warning");
                //if ( console && console.log ) {
                    //console.log(data);
                    //console.log( "error" );
                //}

                //var parsed = JSON.parse(JSON.stringify(data.responseJSON));
                var parsed = data.responseJSON;
                //var arr_data = $.map(parsed, function(el) { return el });
                //console.log(arr_data);
                //console.log(Object.keys(parsed));

                $('#ticketform input[type=text], textarea').each(function (i,item) {
                    //console.log(this);
                    $(this).parent().parent().removeClass("has-error");
                    $('span' ).remove();
                });

                //$('#ticketform input[type=text]').each(function (i,item)
                $(Object.keys(parsed)).each(function (i,key) {
                    //if ( console && console.log ) {
                        //console.log(i);
                        //console.log(key);
                    //}
                    // console.log(Object.keys(item));
                    // var val = $(this).val();
                    //console.log(val);
                    //console.log(JSON.stringify(item[i]));
                    var spanner='<span class="help-block"><strong>' + parsed[key][0] + '</strong></span>';
                    $('#'+key).after(spanner);
                    $('#'+key).parent().parent().addClass("has-error");
                });

            })
            .always(function() {
                $('body').css('cursor', 'default');
                $("#ticketbutton").effect( 'pulsate', options, 500);

                //$('#response').html('<p>Ticket : Submitted<p>');
                //if ( console && console.log ) {
                    //console.log( "finished" );
                //}
                return true;
            });
    });

    $('#upform').submit(function(event) { // capture submit
        event.preventDefault();
        $('#msg').empty();
        $('#files').empty();
        $('body').css('cursor', 'wait');

        // Get some values from elements on the page:
        //var mt = $("#mediatype").val();
        var itid = $("#itemid").val();
        var id = $('#userid').val();

        var token = myLocalStorage.get('ngStorage-token');

        var url= "/api/batch/upload";

        // Get history data

        var fd = new FormData(this); // Need AJAX2
	    //fd.append('file', $('#files')[0].files[0]);

	    //console.log(fd);

        $.ajax({
          //method: "POST",
	      type:'POST',
          url: url,
          cache: false,
          beforeSend: function(xhr, settings) {
            if (token) {
                xhr.setRequestHeader('Authorization','Bearer ' + token);
            }
            // Do not set any of these or xhr file uploads will stop working:
            // xhr.setRequestHeader('Content-Type', 'multipart/form-data');
            // Content-Type:application/x-www-form-urlencoded
            // xhr.setRequestHeader('Content-Type', 'application/json');
            // xhr.overrideMimeType( 'multipart/form-data' );

            start_time = new Date().getTime();
          },
          xhr: function() { // custom xhr (is the best)

            var xhr = new XMLHttpRequest();

            // to trigger refresh of content-type headers
	        xhr.onreadystatechange = function ( response ) {};

            var total = 0;
            // Get the total size of files
            $.each(document.getElementById('files').files, function(i, file) {
		    //console.log(file);
               	total += file.size;
            });

            // Called when upload progress changes. xhr2
            xhr.upload.addEventListener("progress", function(evt) {
                // show progress like example
                var loaded = (evt.loaded / total).toFixed(2)*100; // percent
                    $('#progress').text('Uploading... ' + loaded.toFixed(2) + '%' );
               }, false
            );
            return xhr;
          },
          processData: false,
          contentType: false,
          data: fd,
          success: function( data ) {
               // do something...
               // console.log('uploaded');
               $('#msg').html('<div>Success API upload: <pre class="json">' + library.json.syntaxHighlight(JSON.stringify(data, null, 4)) + '</pre></div>');
               $('#msg > div:last-child').removeClass().addClass("alert alert-success");
               $('#progress').text('Done');
               $('#files').val(null);
                $('body').css('cursor', 'default');
          }
      	  }).fail( function( data ) {
                var request_time = new Date().getTime() - start_time;
                $('#msg').html('<div>Failure API : ' + JSON.stringify(data.responseJSON) + ' (in ' + request_time + 'ms.) </div>');
                $('#msg > div:last-child').removeClass().addClass("alert alert-warning");
                //if ( console && console.log ) {
                    //console.log(data);
                    //console.log( "error" );
                //}
                $('body').css('cursor', 'default');
                return false;
          }).always( function() {
                $('body').css('cursor', 'default');
                $('#msg').append('<p>Status API : Request finished<p>');
                //if ( console && console.log ) {
                    //console.log( "finished" );
                    //}
          });
      });
});
