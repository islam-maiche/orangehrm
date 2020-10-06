<?php

// Allow header partial to be overridden in individual actions
// Can be overridden by: slot('header', get_partial('module/partial'));
include_slot('header', get_partial('global/header'));
$subscribed = $sf_user->isSubscribed();
?>

    </head>
    <body>

        <div id="wrapper">

            <div id="branding">
                <div id="orangeHRM">OrangeHRM</div>
                <?php include_component('buzz', 'viewNotification'); ?>
                <a href="#" id="welcome" class="panelTrigger"><?php echo __("Welcome %username%", array("%username%" => $sf_user->getAttribute('auth.firstName'))); ?></a>
                <script>
                    var marketplaceURL = "<?php echo url_for('marketPlace/ohrmAddons'); ?>";
                    var SubscriberURL = "<?php echo url_for('pim/subscriber'); ?>";
                </script>
                <div id="welcome-menu" class="panelContainer">
                    <ul>
                        <li><?php include_component('communication', 'beaconAbout'); ?></li>
                        <li><a href="<?php echo url_for('admin/changeUserPassword'); ?>"><?php echo __('Change Password'); ?></a></li>
                        <li><a href="<?php echo url_for('auth/logout'); ?>"><?php echo __('Logout'); ?></a></li>
                    </ul>
                </div>
                <?php include_component('communication', 'beaconNotification'); ?>
                <?php include_component('integration', 'osIntegration'); ?>
            </div> <!-- branding -->
                
                <?php include_component('core', 'mainMenu'); ?>
            
            <div class="container">
                <div id="content">

                    <?php echo $sf_content ?>

                </div> <!-- content -->
            </div>
        </div> <!-- wrapper -->

        <div id="footer">
            <?php include_partial('global/copyright');?>
        </div> <!-- footer -->


<?php include_slot('footer', get_partial('global/footer'));?>
