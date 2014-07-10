
        <footer id="bottom">
            <section class="container_12 clearfix">
                <!--<div class="grid_6">
                    <a href="#">Menu 1</a>
                    &middot; <a href="#">Menu 2</a>
                    &middot; <a href="#">Menu 3</a>
                    &middot; <a href="#">Menu 4</a>
                </div>-->
                <div class="grid_6 alignright">
					Copyright &copy; 2012 <a href="javascript:void(0);" target="_blank"><?php echo COMPANY;?></a>
					<a href="http://www.viti.es/gnu/licenses/gpl.html" target="_blank"> Licenciado bajo GNU/GPL V3 </a>
                </div>
            </section>
        </footer>
<!--  <script type="text/javascript">
jQuery(document).ready(function(){
            //Mensaje
            if($('#messages').is(':visible')){
                return false;
            }else{
                $('#messages').slideToggle("fast");
                setTimeout(function(){
                    $.ajax({
                        type:'POST',
                        url:'hideMSG.php',
                        data:{rnd:Math.random(), action:'hideMSG'},
                        success:function(r){ $('#messages').slideToggle("fast"); }, error:function(r){}
                    });
                }, 2500);

            }
        });

    </script>-->
    </body>
</html>
