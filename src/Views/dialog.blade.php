
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('admin_theme/assets/plugins/boostrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_theme/assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('admin_theme/assets/plugins/pnotify/pnotify.custom.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <!-- BEGIN Pages CSS-->
    <link href="{{ asset('admin_theme/pages/css/pages-icons.css') }}" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{{ asset('admin_theme/pages/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <!--[if lte IE 9]>
    <link href="pages/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
        window.onload = function()
        {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="pages/css/windows.chrome.fix.css" />'
        }
    </script>
    <link class="main-stylesheet" href="{{ asset('admin_theme/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.plyr.io/1.5.18/plyr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link type="text/css" rel="stylesheet" href="{{ asset('/filemanager_assets/vendor/dmuploader/css/uploader.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('/filemanager_assets/css/filemanager.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('/filemanager_assets/vendor/contextMenu/dist/jquery.contextMenu.css') }}">

            <!-- Modal Create Folder -->
    <div class="modal fade fill-in" id="modalCreateFolder" tabindex="-1" role="dialog" aria-labelledby="modalFillInLabel" aria-hidden="true">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="pg-close"></i>
        </button>
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-left p-b-5"><span class="semi-bold">New folder</span> name</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9">
                            <input type="text" placeholder="Name of the new folder" class="form-control input-lg" id="folder-name" name="folder-name">
                        </div>
                        <div class="col-md-3 text-center">
                            <button type="button" id="create-folder" class="btn btn-primary btn-lg btn-large fs-15">Create Folder</button>
                        </div>
                    </div>
                    <p class="text-right hinted-text p-t-10 p-r-10">New folder will be created on current folder</p>
                </div>
                <div class="modal-footer">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal Preview -->
    <div class="modal fade slide-up disable-scroll" id="previewInfo" tabindex="-1" role="dialog" aria-labelledby="modalSlideUpLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">

                    </div>
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="pg-close fs-14"></i>
                        </button>
                        <div class="row">
                            <div class="col-md-8" id="modal-preview">

                            </div>
                            <div class="col-md-4 b-l b-grey" id="modal-info">
                                <ul class="no-style">
                                    <li><b>Name</b>: <span id="modal-name"></span></li>
                                    <li><b>Size</b>: <span id="modal-size"></span></li>
                                </ul>
                                <button class="btn btn-complete m-t-30 hide">Download file</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- /.modal-dialog -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><button class="btn btn-complete btn-cons" data-toggle="modal" data-target="#uploadModal"><i class="fa fa-upload"></i> Upload</button></li>
                        <li><button class="btn btn-complete btn-cons" data-toggle="modal" data-target="#modalCreateFolder"><i class="fa fa-folder"></i> Create Folder</button></li>
                        <li class="home"><button class="btn "><i class="fa fa-home"></i></button></li>
                        <li class="refresh"><button class="btn "><i class="fa fa-refresh"></i></button></li>
                        <li class="move"><button class="btn"><i class="fa fa-arrows"></i> Move</button></li>
                        <li class="delete"><button class="btn"><i class="fa fa-trash"></i> Delete</button></li>
                        <li class="preview"><button class="btn"><i class="fa fa-eye"></i> Preview</button></li>
                    </ul>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <form class="navbar-form navbar-right hide" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                        <ul class="nav navbar-nav navbar-right views">
                            <li class="list view-type"><button class="btn "><i class="fa fa-th-list"></i></button></li>
                            <li class="grid view-type active"><button class="btn "><i class="fa fa-th"></i></button></li>
                            <li class="big-grid view-type"><button class="btn "><i class="fa fa-th-large"></i></button></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">

                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
        <div class="panel-body" >
            <div class="row">
                {{--<div class="col-md-2">--}}
                {{--</div>--}}
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <?php $home = explode('/', config('filemanager.homePath')); ?>
                        <li class="active" data-folder="Home"><a href="#">{{ last($home) }}</a></li>
                    </ol>
                </div>
            </div>
            {{--<div class="col-xs-6 col-sm-2 sidebar-offcanvas" id="sidebar" role="navigation">--}}
                {{--<h5>Display</h5>--}}
                {{--<ul class="list-group">--}}
                    {{--<li class="list-group-item filter active" data-filter="all"><i class="fa fa-diamond"></i>All files</li>--}}
                    {{--<li class="list-group-item filter" data-filter="image"><i class="fa fa-image"></i>Images</li>--}}
                    {{--<li class="list-group-item filter" data-filter="video"><i class="fa fa-video-camera"></i>Video</li>--}}
                    {{--<li class="list-group-item filter" data-filter="audio"><i class="fa fa-music"></i>Audio</li>--}}
                    {{--<li class="list-group-item filter" data-filter="documents"><i class="fa fa-file"></i>Documents</li>--}}
                {{--</ul>--}}
                {{--<h5>Order by</h5>--}}
                {{--<select class="cs-select cs-skin-slide full-width" data-init-plugin="cs-select" id="sort-by">--}}
                    {{--<option value="mime">Type</option>--}}
                    {{--<option value="name">Alpha</option>--}}
                    {{--<option value="size">Size</option>--}}
                {{--</select>--}}
            {{--</div>--}}
            {{--<li class="list-group-item filter hide active" data-filter="image"><i class="fa fa-image"></i>Images</li>--}}
            <div class="col-xs-12 col-sm-12">
                <div class="row" id="files_container">
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('admin_theme/assets/plugins/jquery/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_theme/assets/plugins/classie/classie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_theme/assets/plugins/pnotify/pnotify.custom.js') }}"></script>
    <script src="{{ asset('admin_theme/assets/plugins/modernizr.custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_theme/assets/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_theme/assets/plugins/boostrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <script src="https://cdn.plyr.io/1.5.18/plyr.js" type="text/javascript"></script>
    <script src="{{ asset('/filemanager_assets/vendor/pdfobject.js') }}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script src="{{ asset('/filemanager_assets/vendor/contextMenu/dist/jquery.contextMenu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/filemanager_assets/vendor/contextMenu/dist/jquery.ui.position.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('/filemanager_assets/vendor/dmuploader/js/dmuploader.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/filemanager_assets/vendor/dmuploader/js/gallery.js') }}" type="text/javascript"></script>


    <script>
        (function(d, p){
            var a = new XMLHttpRequest(),
                    b = d.body;
            a.open('GET', p, true);
            a.send();
            a.onload = function() {
                var c = d.createElement('div');
                c.setAttribute('hidden', '');
                c.innerHTML = a.responseText;
                b.insertBefore(c, b.childNodes[0]);
            };
        })(document, 'https://cdn.plyr.io/1.5.18/sprite.svg');

    </script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /**
             * Set global variables
             */

            url_process = "{{ url('admin/filemanager/get_folder') }}";
            url_upload  = "{{ url('admin/filemanager/uploadFile') }}";
            url_cfolder = "{{ url('admin/filemanager/createFolder') }}";
            url_delete  = "{{ url('admin/filemanager/delete') }}";
            image_path  = "{{ asset('/') }}";
            homeFolder  = "{{ last($home) }}";
            path_folder = "";
            current_file = null;
            globalFilter = "{{ (isset($_GET['filter'])) ? $_GET['filter'] : 'image' }}";
            typeCallback = "{{ (isset($_GET['type'])) ? $_GET['type'] : 'featured' }}";
            editorId =  "{{ (isset($_GET['editor'])) ? $_GET['editor'] : null }}";
            /**
             * Languages variables
             */

            text_upload = "{!! trans('kgallery.upload.info') !!}";


        });
    </script>
    <script src="{{ asset('filemanager_assets/js/filemanager.js') }}" type="text/javascript"></script>
    <script src="{{ asset('filemanager_assets/js/upload.js') }}" type="text/javascript"></script>
