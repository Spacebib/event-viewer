<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="EventViewer">
    <title>EventViewer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/highlight.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Source+Sans+Pro:400,600' rel='stylesheet'
          type='text/css'>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark p-0">
    <a href="{{ route('event-viewer.index') }}" class="navbar-brand mr-0">
        <i class="fa fa-fw fa-book"></i> EventViewer
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="container-fluid">
    <main role="main" class="pt-3">
        @yield('content')
    </main>
</div>

<footer class="main-footer">
    <div class="container-fluid">
        <p class="text-muted pull-left">
            EventViewer
        </p>
        <p class="text-muted pull-right">
            Created with <i class="fa fa-heart"></i> by Spacebib <sup>&copy;</sup>
        </p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    $(function () {
        if (document.querySelector('#ev-json')) {
            document.querySelector('#ev-json').innerHTML = JSON.stringify(JSON.parse(document.querySelector('#ev-json').textContent), null, 2)
            hljs.highlightBlock(document.querySelector('code'))
        }
        $('[data-toggle="tooltip"]').tooltip()

        var clipboard = new ClipboardJS('.btn-clipboard');
        clipboard.on('success', function (e) {
            console.info('Trigger:', $(e.trigger));
            $(e.trigger).attr('data-original-title', 'Copied!').tooltip('show')
                .attr('data-original-title', 'Copy to Clipboard')
        });

        function bootstrapClearButton() {
            $('.position-relative :input').on('keydown focus', function() {
                if ($(this).val().length > 0) {
                    $(this).nextAll('.form-clear').removeClass('d-none');
                }
            }).on('keydown keyup blur', function() {
                if ($(this).val().length === 0) {
                    $(this).nextAll('.form-clear').addClass('d-none');
                }
            });
            $('.form-clear').on('click', function() {
                $(this).addClass('d-none').prevAll(':input').val('');
            });
        }
        bootstrapClearButton();
    })
</script>
@yield('modals')
@yield('scripts')
</body>
</html>
