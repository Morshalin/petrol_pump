<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        *{
            box-sizing: border-box;
            margin:  0px;
            padding:  0px;
        }
        ._404{
            height: 100vh;
            width: 100%;
            background: -webkit-linear-gradient( 90deg, #782d7a 0% 10%, #999933 10% 20%, #fb59ac 20% 30%, #339999 30% 40%, #82cf0c 40% 50%, #abcdef 50% 60%, #987654 60% 70%, #564320 70% 80%, #a5d3c0 80% 90%, #1f8a3c 90% 100%
                );
            background: -o-linear-gradient( 90deg, #782d7a 0% 10%, #999933 10% 20%, #fb59ac 20% 30%, #339999 30% 40%, #82cf0c 40% 50%, #abcdef 50% 60%, #987654 60% 70%, #564320 70% 80%, #a5d3c0 80% 90%, #1f8a3c 90% 100%
                );
            background: linear-gradient( 90deg, #782d7a 0% 10%, #999933 10% 20%, #fb59ac 20% 30%, #339999 30% 40%, #82cf0c 40% 50%, #abcdef 50% 60%, #987654 60% 70%, #564320 70% 80%, #a5d3c0 80% 90%, #1f8a3c 90% 100%
                );
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            user-select: none;
        }
        ._404::after{
            content: '';
            height: 80px;
            width: 120%;
            background: #000;
            filter: blur(8px);
            opacity: .3;
            display: block;
            position: absolute;
            top: 0px;
            left: -10%;
            -webkit-animation: _404move 3s linear infinite;
            -o-animation: _404move 3s linear infinite;
            animation: _404move 3s linear infinite;
        }
        @keyframes _404move{
            0%{
                top: -100px;
                filter: blur(5px);
            }
            100%{
                top: 120%;
                filter: blur(18px);
            }
        }
        ._404 .main{
            text-align: center;
        }
        ._404 .main ._text{
            font-size: 200px;
            color: #565656;
            font-weight: 600;
            letter-spacing: 10px;
            text-shadow: 4px 4px 5px #993;
        }
        ._404 .main .notFound{
            font-size: 30px;
            text-shadow: 4px 4px 5px #993;
            margin-bottom: 10px;
        }
        ._404 .main ._backToHome a{
            text-decoration: none;
            color: #444;
            background: #fff;
            display: inline-block;
            padding: 14px 40px 12px;
            font-size: 20px;
            text-transform: uppercase;
            border-radius: 4px;
            transition: .5s;
        }
        ._404 .main ._backToHome a:hover{
            background: #993;
            color: #fff;
            box-shadow: 0 4px 4px #888;
            transform: translateY(-3px) scale(1.01);
        }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    @yield('message')
                </div>
            </div>
        </div>
    </body>
</html>
