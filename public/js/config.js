/* jslint node: true, maxerr: 50, indent: 4 */

"use strict";

$( document ).ready(function() {

    //Prepare jTable
    var url= "/api/bouncers/";

    $('#TableContainer').jtable({
        title: 'Table of Bouncers',
        actions: {
            //listAction:     '/api/bouncers'
            listAction: function (postData, jtParams) {
                return $.Deferred(function ($dfd) {
                    $.ajax({
                        method: "GET",
                        url: url,
                        dataType: 'json',
                        // data: JSON.stringify(fdata),
                        data: postData,
                        cache: false,
                        beforeSend: function(xhr, settings) {
                            if (token) {
                                xhr.setRequestHeader('Authorization','Bearer ' + token);
                            }
                            xhr.setRequestHeader('Content-Type', 'application/json');
                            xhr.overrideMimeType( 'application/json' );
                            start_time = new Date().getTime();
                        },
                        success: function (data) {
                            $dfd.resolve(data);
                        },
                        error: function () {
                            $dfd.reject();
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
            },
            createAction:   '/api/bouncers',
            updateAction:    '/api/bouncers',
            deleteAction: '/api/bouncers'
        },
        fields: {
            id: {
                key: true,
                create: false,
                edit: false,
                list: false
            },
            bouncer_id: {
                key: true,
                create: true,
                edit: true,
                list: true
            },
            label: {
                title: 'Bouncer Name',
                width: '40%'
            },
            description: {
                title: 'Description',
                width: '20%'
            },
            tag: {
                title: 'Tag',
                width: '30%',
                create: true,
                edit: true
            }
        }
    });

    //Load person list from server

    //$('#TableContainer').jtable('load');
});
