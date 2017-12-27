/* jslint node: true, maxerr: 50, indent: 4 */

"use strict";

$( document ).ready(function() {

    //Prepare jTable
    var url= "/api/bouncers";
    var token = myLocalStorage.get('ngStorage-token');
    var cachedCategoryOptions;

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
                        //data: postData,
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
                            //console.log(data);
                            /*
                              "Result": "OK",
                              "Records": [ ],
                              "TotalRecordCount": 2
                            */
                            var mdata = new Object ;
                            mdata['Result']='OK';
                            mdata['Records']=data.bouncers;
                            mdata['TotalRecordCount']=Object.keys(data.bouncers).length;
                            console.log(mdata);
                            $dfd.resolve(mdata);
                        },
                        error: function () {
                            $dfd.reject();
                        }
                    }).done(function( data ) {
                        $('body').css('cursor', 'default');
                        $('#msg').html('Found ' + Object.keys(data.bouncers).length + ' results');
                        $('#msg').removeClass().addClass("alert alert-info");
                        //console.log(data);
                        var request_time = new Date().getTime() - start_time;
                        if ( console && console.log ) {
                            console.log( data );
                        }

/*
                        //$('#mainview').empty().addClass("list-group");
                        $('#mainview').empty();
                        $.each(data, function(i, bouncers) {
                            if(bouncers.error) {
                                bouncerInError(bouncers);
                            } else {
                                bouncerInSuccess(bouncers,section_id);
                            }
                        });
*/
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
            createAction: '/api/bouncers',
            updateAction: '/api/bouncers',
            deleteAction: '/api/bouncers'
        },
        fields: {
            id: {
                title: 'Internal ID',
                key: true,
                create: false,
                edit: false,
                list: false
            },
            bouncer_id: {
                title: 'Bouncer ID',
                key: true,
                create: true,
                edit: true,
                list: true
            },
            category_id: {
                title: 'Category',
                    options: function () {
                        if (cachedCategoryOptions) { //Check for cache
                            return cachedCategoryOptions;
                        }

                        var options = [];

                        $.ajax({ //Not found in cache, get from server
                            url: 'api/categories',
                            method: "GET",
                            dataType: 'json',
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
                                /*
                                if (data.Result != 'OK') {
                                    alert(data.Message);
                                    return;
                                }*/
                                options = data.Options;
                            }
                        });

                        return cachedCategoryOptions = options; //Cache results and return options
                    }
            },
            label: {
                title: 'Label',
                //width: '40%'
            },
            description: {
                title: 'Description',
                //width: '20%'
            },
            dsn: {
                title: 'DSN config',
                //width: '20%'
            },
            priority: {
                title: 'Priority',
                //width: '20%'
            },
            enabled: {
                title: 'Enabled',
                //width: '20%'
            },
            tag: {
                title: 'Tag',
                //width: '30%',
                create: true,
                edit: true
            },
            role: {
                title: 'Role',
                //width: '30%',
                create: true,
                edit: true
            }
        }
    });

    //Load person list from server

    $('#TableContainer').jtable('load');
});
