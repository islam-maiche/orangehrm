<?php echo stylesheet_tag(plugin_web_path('orangehrmDashboardPlugin', 'css/orangehrmDashboardPlugin.css')); ?>
<style type="text/css">
    #dashboard__employeeDistribution, #dashboard__pendingLeaveRequests {
        border-radius: 5px;
        background-color: white;
    }
    .panel_wrapper {
        display: flex;
        flex-direction: row;
    }

    .outerbox {
        margin-bottom: 1rem !important;
    }
    .loadmask {
        top:0;
        left:0;
        -moz-opacity: 0.5;
        opacity: .50;
        filter: alpha(opacity=50);
        background-color: #CCC;
        width: 100%;
        height: 100%;
        zoom: 1;
        background: #fbfbfb url("<?php echo plugin_web_path('orangehrmDashboardPlugin', 'images/loading.gif') ?>") no-repeat center;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
    }
    
    .row::after {
        content: "";
        clear: both;
        display: table;
    }
    /* For mobile phones: */
    [id*="panel_draggable_1"] {
    width: 100% !important;
    }

    @media only screen and (min-width: 950px) {
    /* For tablets: */
    #panel_draggable_1_0 {width: 37% !important;}
    #panel_draggable_1_1 {width: 57% !important;}
    }
    panel_draggable_1_0
</style>
<div class="box">
    <!-- <div class="head">
        <h1><?php echo __('Dashboard'); ?></h1>
    </div> -->
    <div class="inner">
        <?php if (count($settings) == 0): ?>
            <div id="messagebar" style="margin-left: 16px;width: 700px;">
                <span style="font-weight: bold;">No Groups are Assigned</span>
            </div>
        <?php endif; ?>
        <?php
        foreach ($settings->getRawValue() as $groupKey => $config):
            ?>
            <div class="outerbox no-border" style="<?php echo isset($config['attributes']['width']) ? "width:" . ($config['attributes']['width'] ) . "px;" : "width:auto" ?>">
                <div id="<?php echo "group_" . $groupKey ?>" class="maincontent group-wrapper">
                    <?php
                    if (!empty($config['attributes']['title'])):
                        ?>
                        <div class="mainHeading">
                            <h2 class="paddingLeft"><?php echo $config['attributes']['title']?></h2>
                        </div>
                        <?php
                    endif;
                    ?>
                    <div id="panel_wrapper_<?php echo $groupKey ?>" class="panel_wrapper row" style="<?php echo isset($config['attributes']['width']) ? "width:" . ($config['attributes']['width']) . ";" : "width:auto;" ?> <?php echo isset($config['attributes']['height']) ? "height:" . ($config['attributes']['height']) . ";" : "height:auto;"; ?>">
                        <?php foreach ($config['panels'] as $panelKey => $panel): ?>
                            <!-- <?php $styleString = isset($panel['attributes']['width']) ? "width:" . $panel['attributes']['width'] . ";" : ""; ?> -->
                            <?php $styleString = "width: 100%;"; ?>
                            <div id="<?php echo "panel_draggable_" . $groupKey . "_" . $panelKey; ?>" class="panel_draggable panel-preview" style="margin:4px; <?php echo isset($panel['attributes']['width']) ? "width:" . $panel['attributes']['width'] . ";" : "width:auto;"; ?> <?php echo isset($panel['attributes']['height']) ? "height:" . $panel['attributes']['height'] . "px;" : "height:auto"; ?>">
                                <fieldset id="<?php echo "panel_resizable_" . $groupKey . "_" . $panelKey; ?>" class="panel_resizable panel-preview" style="<?php echo $styleString; ?> <?php echo isset($panel['attributes']['height']) ? "height:" . $panel['attributes']['height'] . ";" : "height:auto"; ?> ">
                                    <!-- <legend><?php echo __($panel['name']); ?></legend> -->
                                    <?php include_component('dashboard', 'ohrmDashboardSection', $panel['attributes']) ?>
                                </fieldset> 
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>
</div>