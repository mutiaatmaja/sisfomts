<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title') - Sistem Informasi Mts</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('gambarutama/logomts.png') }}"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('html/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('html/layouts/modern-light-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('html/layouts/modern-light-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('html/src/assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('html/src/assets/css/dark/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        .error-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .error-container {
            text-align: center;
            background: white;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
        }
        .error-code {
            font-size: 6rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        .error-title {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
        }
        .error-message {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn-error {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary-error {
            background: #667eea;
            color: white;
            border: 2px solid #667eea;
        }
        .btn-primary-error:hover {
            background: #5a6fd8;
            border-color: #5a6fd8;
            color: white;
            transform: translateY(-2px);
        }
        .btn-secondary-error {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }
        .btn-secondary-error:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }
        .error-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }
        @media (max-width: 768px) {
            .error-container {
                padding: 2rem;
                margin: 1rem;
            }
            .error-code {
                font-size: 4rem;
            }
            .error-title {
                font-size: 1.5rem;
            }
            .error-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body class="layout-boxed">
    <div class="error-page">
        <div class="error-container">
            @yield('content')
        </div>
    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('html/src/plugins/src/global/vendors.min.js') }}"></script>
    <script src="{{ asset('html/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('html/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('html/src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
    <script src="{{ asset('html/src/plugins/src/waves/waves.min.js') }}"></script>
    <script src="{{ asset('html/layouts/modern-light-menu/app.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>
</html>
