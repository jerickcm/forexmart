<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo $template['title']; ?></title>
        <style type="text/css">
            body {margin: 0; padding: 0; font-family: Arial, Tahoma; font-size: 16px; color: #000; background-color: #FFF; min-width: 1010px}
            .top {background-color: #0055A7;}
            .top h1 {margin: 10px 20px 10px 10px; font-size: 25px; font-weight: normal; color: #FFF; display: inline-block; vertical-align: middle; }
            .top .menu, .top .menu li {margin: 0; padding: 0; list-style: none; display: inline-block; vertical-align: middle; }
            .top .menu li {margin: 0; padding: 0; list-style: none; display: inline-block;}
            .top .menu li a {padding: 20px; font-size: 16px; color: #FFF; text-decoration: none; text-align: center; display: block;}
            .top .menu li a:hover {background-color: #0B6ABF;}
            .top .menu li a.selected {background-color: #2989DF; color: #FFF;}
            .content { box-shadow: 0 0 20px rgba(0,0,0,0.5); position: relative; }
            .footer {text-align: center; padding: 20px; color: #0A0A0A; font-size: 14px}
        </style>
    </head>

    <body>
        <div class="top">
            <h1>ForexMart</h1>
            <ul class="menu">
                <!--<li><a href="#">Services</a></li>-->
                <li><a href="#" class="selected">Web Terminal</a></li>
                <!--<li><a href="#">News</a></li>-->
                <!--<li><a href="#">Contact</a></li>-->
            </ul>
        </div>
        <div class="content">
            <!-- Web Terminal Code Start -->
            <iframe src="https://trade.mql5.com/trade?servers=ForexMart-DemoServer,ForexMart-RealServer&trade_server=ForexMart-RealServer&demo_server=ForexMart-DemoServer&
            demo_type=StUS,StEU&demo_leverage=50,100,200,500&lang=en" allowfullscreen="allowfullscreen" style="width: 100%; height: 700px; border: none"></iframe>
            <!-- Web Terminal Code End -->
        </div>
        <div class="footer">
            Copyright 2015 - <?php echo date('Y');?>, ForexMart
        </div>
    </body>
</html>