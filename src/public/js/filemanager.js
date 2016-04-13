/**
 * Created by infinety on 8/3/16.
 */

$(document).ready(function(){

    /******************
     * MAIN FUNCTIONS *
     ******************/

    /**
     * Add Loading div
     */
    addLoading = function(){
        $("#files_container").empty().html('<div class="loading"><img src="'+image_path+'filemanager_assets/img/loading.svg"></div>');
    };


    /**
     * Get folder and files data
     *
     * @param folder
     * @param sort
     * @param filter
     */
    getData = function(folder, sort, filter){
        current_file = null;
        actionFileButtons();
        addLoading();
        $.ajax({
            url: url_process,
            type: "POST",
            data: { 'folder' : folder, 'sort' : sort, 'filter' : filter }
        }).done(function( data ) {
            uploadMethod();
            generatebreadcrum(folder);
            actionRightMenu();
            $("#files_container").empty();
            $("#files_container").html(data);

        }).fail(function(data) {
            console.log('error');
        });
    };



    /**
     * Create a new folder on current Folder
     *
     * @param name
     */
    createFolder = function(name){
        $.ajax({
            url: url_cfolder,
            type: "POST",
            data: { 'folder' : path_folder, 'name' : name }
        }).done(function( data ) {
            if(data.error){
                new PNotify({
                    title: 'Error',
                    text: data.error,
                    type: 'error'
                });
            } else {
                new PNotify({
                    title: 'Folder Created!',
                    text: data.success,
                    type: 'success'
                });
                $('.refresh').trigger('click');
            }
            $('#modalCreateFolder').modal('hide')

        }).fail(function(data) {
            new PNotify({
                title: 'Error',
                text: 'Error to process request',
                type: 'error'
            });
            $('#modalCreateFolder').modal('hide')
        });
    };

    deleteFileorFolder = function(name, type){
        $.ajax({
            url: url_delete,
            type: "POST",
            data: { 'folder' : path_folder, 'data' : name, 'type' : type }
        }).done(function( data ) {
            if(data.error){
                new PNotify({
                    title: 'Error',
                    text: data.error,
                    type: 'error'
                });
            } else {
                new PNotify({
                    title: 'Deleted!',
                    text: data.success,
                    type: 'success'
                });
                $('.refresh').trigger('click');
            }

        }).fail(function(data) {
            new PNotify({
                title: 'Error',
                text: 'Error to process request',
                type: 'error'
            });
        });
    };

    /**
     * Generates breadcrum for given folder
     *
     * @param folder
     */
    generatebreadcrum = function(folder){
        var breadcrum = folder.split("/");
        var html = '<li class="active" data-folder="Home"><a href="#">'+homeFolder+'</a></li>';
        var folder = '';
        for(var i = 0; i < breadcrum.length; i++) {
            if(breadcrum[i] != '') {
                folder += breadcrum[i] + "/";
                html += '<li class="active" data-folder="' + folder + '"><a href="#">' + breadcrum[i] + '</a></li>';
            }
        }
        $(".breadcrumb").html(html);
    };


    /**
     * Active or deactivate buttons
     */
    actionFileButtons = function(){
        if(current_file === undefined || current_file === null){
            $(".delete ,.move ,.preview").removeClass('active');
        } else {
            if(current_file.type != 'file'){
                $(".delete ,.move ,.preview").addClass('active');
            } else {
                $(".preview").removeClass('active');
                $(".delete ,.move").addClass('active');
            }
        }
    };

    actionRightMenu = function(){
        $.contextMenu({
            selector: '.filemanager-item',
            build: function($trigger, e) {
                // this callback is executed every time the menu is to be shown
                // its results are destroyed every time the menu is hidden
                // e is the original contextmenu event, containing e.pageX and e.pageY (amongst other data)
                current_file = null;
                if($trigger.data('type')){
                    if($trigger.data('type') != 'file'){
                        current_file = {
                            name : $($trigger).find('.name-file').text(),
                            path : $($trigger).data('path'),
                            type : $($trigger).data('type'),
                            size : $($trigger).data('size'),
                            preview : $($trigger).find('img').attr("src")
                        };
                        console.log(current_file);
                    }
                }

                return {
                    callback: function(key, options) {
                        process(key, options)
                        //var m = "clicked: " + key;
                        //window.console && console.log(m) || alert(m);
                    },
                    items: generateContextMenu()
                };
            }
        });
    };

    /**
     * Generates
     * @returns {Array}
     */
    function generateContextMenu() {

        $elements = [];

        // Only for supported mimes
        if(current_file != undefined && current_file.type != 'file'){
            var preview = {
                    name: "Preview",
                    icon: 'fa-eye',
                    callback: function(key, options) {
                        console.log(current_file);
                        $('.preview').trigger('click');
                    }
                };

            var download = {
                name: "Download",
                icon: 'fa-download',
                callback: function(key, options) {

                }
            };

            $elements.push(preview);
            $elements.push(download);
        }

        var cut = {
            name: "Cut",
            icon: 'fa-scissors',
            callback: function(key, options) {

            }
        };
        var paste = {
            name: "Paste",
            icon: 'fa-clipboard',
            callback: function(key, options) {

            }
        };
        var del = {
            name: "Delete",
            icon: 'fa-trash',
            callback: function(key, options) {

                if($(this).data('type')){
                    swal(
                        {  title: "Are you sure?",
                            text: "This file will be deleted!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it!",
                            closeOnConfirm: true
                        }, function(){
                            deleteFileorFolder(current_file.name, 'file');
                        }
                    );
                }
                if($(this).data('folder')){
                    var name = $(this).data('name');
                    swal(
                        {  title: "Are you sure?",
                            text: "All files and folders inside this folder will by deleted!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it!",
                            closeOnConfirm: true
                        }, function(){
                            deleteFileorFolder(name, 'folder');
                        }
                    );
                }
            }
        };

        $elements.push(cut);
        $elements.push(paste);
        $elements.push(del);

        return $elements;

    };


    /**
     * Preview function to show a preview of the file
     *
     * @returns {boolean}
     */
    preview = function(){
        if(current_file === undefined || current_file === null){
            return false;
        } else {
            if(current_file.type != 'file'){
                $("#modal-name").text(current_file.name);
                $("#modal-size").text(current_file.size);
                $('#modal-preview').empty();
                if(current_file.type == 'image'){
                    $('#modal-preview').append('<img src="'+ current_file.preview +'" class="img-responsive" id="modal-image">');
                }
                if(current_file.type == 'audio'){
                    var html = '<div class="plyr">' +
                                    '<audio controls>' +
                                        '<source src="'+ current_file.path +'" type="audio/mpeg">' +
                                        'Your browser does not support the audio element.' +
                                    '</audio>' +
                                '</div>';
                    $('#modal-preview').append(html);
                    plyr.setup('.plyr');
                }
                if(current_file.type == 'video'){
                    var html = '<div class="plyr">' +
                                    '<video  controls>' +
                                        '<source src="'+ current_file.path +'" type="video/mp4">' +
                                        '<a href="'+ current_file.path +'">Download</a>' +
                                    '</video>' +
                                '</div>';
                    $('#modal-preview').append(html);
                    plyr.setup('.plyr');
                }
                if(current_file.type == 'pdf'){
                   new PDFObject({ url: current_file.path, height: '500px' }).embed("modal-preview");
                }

                $('#previewInfo').modal('toggle')
            }
        }
    };

    /**
     * Close event for preview modal
     */
    $('#previewInfo').on('hidden.bs.modal', function (e) {
        player = plyr.setup('.plyr')[0];
        if(player != undefined || player != null){
            player.destroy();
        }
        current_file = null;
    })



    //Call first time
    getData('', '', '');


    /*****************
     *    EVENTS     *
     *****************/
    $('.filter').click(function(){
        var filter = $(this).data('filter');
        var sort = $("#sort-by").val();
        getData(path_folder, sort, filter);
        $('.filter').removeClass('active');
        $(this).addClass('active');
    });

    $("#sort-by").change(function(){
        var filter = $('.filter.active').data('filter');
        var sort = $(this).val();
        getData(path_folder, sort, filter);

    });

    /**
     * Home click
     */
    $(document).on('click', '.home', function(){
        path_folder = '';
        var filter = $('.filter.active').data('filter');
        var sort = $("#sort-by").val();
        getData('', sort, filter);
    });

    /**
     * Refresh current folder
     */
    $(document).on('click', '.refresh', function(){
        var filter = $('.filter.active').data('filter');
        var sort = $("#sort-by").val();
        getData(path_folder, sort, filter);
    });

    $(document).on('click', '.preview', function(){
        preview();
    });


    /**
     * Get inside folder
     */
    $(document).on('click', '.folder', function(){
        path_folder = $(this).data('folder');
        var filter = $('.filter.active').data('filter');
        var sort = $("#sort-by").val();
        getData(path_folder, sort, filter);
    });



    /**
     * Files events
     */
    $(document).on('click', '.file', function(e){
        e.preventDefault();
        if($(this).hasClass('active')){
            current_file = null;
            $(this).removeClass('active');
        } else {
            current_file = {
                name : $(this).find('.name-file').text(),
                path : $(this).data('path'),
                type : $(this).data('type'),
                size : $(this).data('size'),
                preview : $(this).find('img').attr("src")
            };
            $('.file').removeClass('active');
            $(this).addClass('active');
        }
        actionFileButtons();
        return false;
    });


    $(document).on('click', '#create-folder', function(e){
        var new_folder = $("#folder-name").val();
        createFolder(new_folder);
    });

    $(document).on('click', '.delete', function(e){
        swal(
            {  title: "Are you sure?",
                text: "This file will be deleted!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }, function(){
                deleteFileorFolder(current_file.name, 'file');
            }
        );
    });




    /**
     * Navigation through breadcrum
     */
    $(document).on('click', '.breadcrumb li a', function(){
        var folder = $(this).parent().data('folder');
        if(folder == 'Home'){
            path_folder = '';
        } else {
            path_folder = folder;
        }
        var filter = $('.filter.active').data('filter');
        var sort = $("#sort-by").val();
        getData(path_folder, sort, filter);
    });


    /**
     * Change view items
     */
    $(document).on('click', '.list', function(){
        $(".view-type").removeClass('active');
        $(this).addClass('active');
        $('.item').removeClass('grid col-sm-3 big-grid col-sm-6').addClass('list col-sm-12')
        $('.item').find('.icon').removeClass('col-sm-4 col-sm-2').addClass('col-sm-1');
        $('.item').find('.info').removeClass('col-sm-8 col-sm-10').addClass('col-sm-11');
    });

    $(document).on('click', '.grid', function(){
        $(".view-type").removeClass('active');
        $(this).addClass('active');
        $('.item').removeClass('list col-sm-12 big-grid col-sm-6').addClass('grid col-sm-3')
        $('.item').find('.icon').removeClass('col-sm-1 col-sm-2').addClass('col-sm-4');
        $('.item').find('.info').removeClass('col-sm-11 col-sm-10').addClass('col-sm-8');
    });

    $(document).on('click', '.big-grid', function(){
        $(".view-type").removeClass('active');
        $(this).addClass('active');
        $('.item').removeClass('list col-sm-12 grid col-sm-3').addClass('big-grid col-sm-6')
        $('.item').find('.icon').removeClass('col-sm-1 col-sm-4').addClass('col-sm-2');
        $('.item').find('.info').removeClass('col-sm-11 col-sm-8').addClass('col-sm-10');
    });

});