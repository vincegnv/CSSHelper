<!--
author: Vince Ganev
-->

        <?php
            require('../Templates/header.php');
            require('../Templates/buttonLeftColumn.php');
            require('../Templates/buttonRightColumn.php');
            require('../Templates/footer.php')
        ?>

        <script type="text/javascript">
//            var button = new ButtonProperties();
            
            $(document).ready(function(){
//                $(".spinner input:button").mouseup(spinnerStop);
                $("input.property:text").on("change",function(){
                    var id = $(this).attr('id');
                    if(id==="buttonWidth"){
                        $("#theButton").css({'width':$(this).val()+'px'});
                    } else if(id==="buttonHeight"){
                        $("#theButton").css({'height':$(this).val()+'px'});                        
                    } else if (id==="buttonText"){
                        $("#theButton").attr('value', $(this).val());                        
                    } else if(id==="buttonFontSize"){
                        $("#theButton").css({'font-size':$(this).val()+'pt'});                        
                    }
                });
            });
        </script>