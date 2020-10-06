<?php use_stylesheet(plugin_web_path('orangehrmDashboardPlugin', 'css/quicklaunch.css'));
use_javascript(plugin_web_path('orangehrmDashboardPlugin', 'js/jquery.easing.1.3.js'));
?>

<style type="text/css">
* {
  box-sizing: border-box;
}

    #dashboard-quick-launch-panel-container {
        height: auto;
    }
    #dashboard-quick-launch-panel-menu_holder {
        height: auto;
        width: 100%;
    }
    .quickLinkText{
        display: block;
        text-align: center;
        color: white;
        font-size: 1rem;
        font-weight:bold;
        margin-left: 1rem;
        margin-bottom: 1rem;
    }
    a:hover, a:visited, a:link, a:active{
        text-decoration: none;
    }
    div.quickLaunge{
        /* width: 90%; */
        height: 90px;
        /* height: 80px; */
        margin: 3px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: start;
        vertical-align:middle;
        text-align:center
    }
    div.quickLaunge img{
        width: 50px;
        height: 50px;
    }
    table.quickLaungeContainer{
        table-layout: fixed;
        width: 100%;
        height: 100%;
        /* width: auto; */
    }

    .row {
        display: flex;
    }
    
    .row::after {
        content: "";
        clear: both;
        display: table;
    }
    /* For mobile phones: */
    [class*="col-"] {
    width: 100%;
    }

    @media only screen and (min-width: 650px) {
    /* For tablets: */
    .col-xs-1 {width: 7.33%;}
    .col-xs-2 {width: 15.66%;}
    .col-xs-3 {width: 24%;}
    .col-xs-4 {width: 32.33%;}
    .col-xs-5 {width: 40.66%;}
    .col-xs-6 {width: 48%;}
    .col-xs-7 {width: 57.33%;}
    .col-xs-8 {width: 65.66%;}
    .col-xs-9 {width: 74%;}
    .col-xs-10 {width: 82.33%;}
    .col-xs-11 {width: 90.66%;}
    .col-xs-12 {width: 100%;}
    }
    @media only screen and (min-width: 800px) {
    /* For tablets: */
    .col-s-1 {width: 7.33%;}
    .col-s-2 {width: 15.66%;}
    .col-s-3 {width: 24%;}
    .col-s-4 {width: 32.33%;}
    .col-s-5 {width: 40.66%;}
    .col-s-6 {width: 48%;}
    .col-s-7 {width: 57.33%;}
    .col-s-8 {width: 65.66%;}
    .col-s-9 {width: 74%;}
    .col-s-10 {width: 82.33%;}
    .col-s-11 {width: 90.66%;}
    .col-s-12 {width: 100%;}
    }
    @media only screen and (min-width: 950px) {
    /* For desktop: */
    .col-1 {width: 7.33%;}
    .col-2 {width: 15.66%;}
    .col-3 {width: 24%;}
    .col-4 {width: 32.33%;}
    .col-5 {width: 40.66%;}
    .col-6 {width: 49%;}
    .col-7 {width: 57.33%;}
    .col-8 {width: 65.66%;}
    .col-9 {width: 74%;}
    .col-10 {width: 82.33%;}
    .col-11 {width: 90.66%;}
    .col-12 {width: 100%;}
    }
</style>

<div id="dashboard-quick-launch-panel-container">
    <div id="dashboard-quick-launch-panel-menu_holder" class="row">
        <!-- <table class="quickLaungeContainer"> -->
            <?php
            $links = $links->getRawValue();
            if ($links) :
                $numLinks = count($links);
                $numCols = ceil($numLinks / $numRows);
                $linkNdx = 0;
                $colors = array('#3689e5', '#8e24aa', '#43a047', '#e53934', '#3689ca', '#ffd04c');
                for ($rows = 0; ($rows < $numRows) && ($linkNdx < $numLinks); $rows++) :
                    ?>
                    <!-- <tr> -->
                        <?php
                        for ($cols = 0; ($cols < $numCols) && ($linkNdx < $numLinks); $cols++) :
                            $link = $links[$linkNdx];
                            $color = $colors[$linkNdx];
                            $linkNdx++;
                            ?>
                            <!-- <td> -->
                                <div class="quickLaunge col-2 col-s-4 col-xs-6" style="<?php echo "background-color:". $color ?>">
                                    <a href="<?php echo url_for($link['url']); ?>" target="<?php echo $link['target'] ?>" >
                                        <!-- <img src="<?php echo plugin_web_path($link['plugin'] , 'images/' . $link['image']) ?>"/> -->
                                        <span class="quickLinkText"><?php echo __($link['name']) ?></span>
                                    </a>
                                </div>                        
                            <!-- </td>                     -->
                    <?php endfor; ?>
                    <!-- </tr> -->
                <?php endfor;
                endif; ?>
            <!-- else :
                ?>
                <tr><td><?php echo __('No Links'); ?></td></tr>               

        </table> -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        // hover color change effect
        $("#dashboard-quick-launch-panel-slider li").hover(function () {
            $(this).animate({opacity: 0.90}, 100, function () {
                $(this).animate({opacity: 1}, 0);
            });
        });
        // Trigger mouse move event over the 'menu_holder'.
        $("#dashboard-quick-launch-panel-menu_holder").mousemove(function (e) {
            // Enable scroll function only when the height of the 'slider' or menu is greater than the 'menu_holder'.
            if ($(this).height() < $("#dashboard-quick-launch-panel-slider").height()) {
                // Calculate the distance value from the 'menu_holder' y pos and page Y pos.
                var distance = e.pageY - $(this).offset().top;
                // Get the percentage value with respect to the Mouse Y on the 'menu_holder'.
                var percentage = distance / $(this).height();
                // Calculate the new Y position of the 'slider'. 
                var targetY = -Math.round(($("#dashboard-quick-launch-panel-slider").height() - $(this).height()) * percentage);
                // With jQuery easing funtion from easing plugin.
                $('#dashboard-quick-launch-panel-slider').animate({top: [targetY + "px", "easeOutCirc"]}, {queue: false, duration: 200});
                // Without easeing function. by default jQuery have 'swing'.
                //$('#slider').animate({top: [targetY+"px", "easeOutCirc"]}, { queue:false, duration:200 });
            }
        });
    });

</script>