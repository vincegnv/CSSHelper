<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script  type="text/javascript">
            function changeValue(n){
                var spinner = document.getElementById("spinnervalue");
                spinner.value = parseInt(spinner.value)+n;
            }        
        </script>
        <style>
            .spinner{
                margin-left: 50px;
                margin-top: 50px;
                /*background: red;*/
                float: left;
                display: table;
            }
            .spinner ul{
                list-style: none;
                display: inline-block;
                line-height: 0;
                vertical-align: middle;
                float: left;
            }
            * {
                padding: 0;
                margin: 0;
            }
            .spinner input{
                height: 26px;
                width: 40px;
                vertical-align: middle;
                float: left;
                text-align: center;
            }
            .spinner input[type="button"]{
                font-size: 8px;
                text-align: center;
                height: 15px;
                width:15px;
            }
            
        </style>
    </head>
    <body>
        <div class="spinner">
            <input type="text" value="0" id="spinnervalue"/>
            <ul>
                <li>
                    <input type="button" value="&#9650;" onmousedown="changeValue(1);"/>
                </li>
                <li>
                    <input type="button" value="&#9660;" onmousedown="changeValue(-1);"/>                    
                </li>
            </ul>
        </div>
    </body>
</html>
