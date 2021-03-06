<?php
echo use_stylesheet(plugin_web_path('orangehrmCorePlugin', 'css/mainMenuComponent.css'));
echo use_javascript(plugin_web_path('orangehrmCorePlugin', 'js/mainMenuComponent.js'));

function getSubMenuIndication($menuItem) {
    
    if (count($menuItem['subMenuItems']) > 0) {
        return ' class="arrow"';
    } else {
        return '';
    }
    
}

function getListItemClass($menuItem, $currentItemDetails, $additionalClasses = []) {
    $additionalClasses = implode(" ", $additionalClasses);

    if ($menuItem['level'] == 1 && $menuItem['id'] == $currentItemDetails['level1']) {
        return empty($additionalClasses) ? ' class="current"' : ' class="current ' . $additionalClasses . '"';
    } elseif ($menuItem['level'] == 2 && $menuItem['id'] == $currentItemDetails['level2']) {
        return empty($additionalClasses) ? ' class="selected"' : ' class="selected ' . $additionalClasses . '"';
    }

    return empty($additionalClasses) ? '' : ' class="' . $additionalClasses . '"';
}

function getMenuUrl($menuItem) {
    
    $url = '#';
    
    if (!empty($menuItem['module']) && !empty($menuItem['action'])) {
        $url = url_for($menuItem['module'] . '/'. $menuItem['action']);
        $url = empty($menuItem['urlExtras'])?$url:$url . $menuItem['urlExtras'];
    }
    
    return $url;
    
}

function getHtmlId($menuItem) {
    
    $id = '';
    
    if (!empty($menuItem['action'])) {
        $id = 'menu_' . $menuItem['module'] . '_' . $menuItem['action'];
    } else {
        
        $module             = '';
        $firstSubMenuItem   = $menuItem['subMenuItems'][0];
        $module             = $firstSubMenuItem['module'] . '_';
        
        $id = 'menu_' . $module . str_replace(' ', '', $menuItem['menuTitle']);
        
    }
    
    return $id;
    
}

?>

<div id="mainMenu" class="menu">
    General
    <ul id="mainMenuFirstLevelUnorderedList" class="main-menu-first-level-unordered-list main-menu-first-level-unordered-list-width">
        
        <?php foreach ($menuItemArray as $firstLevelItem) : ?>

            <li<?php echo getListItemClass($firstLevelItem, $currentItemDetails, ['main-menu-first-level-list-item']); ?>><a href="<?php echo getMenuUrl($firstLevelItem); ?>" id="<?php echo getHtmlId($firstLevelItem); ?>" class="firstLevelMenu"><b><?php echo __($firstLevelItem['menuTitle']) ?></b></a>

            
            <?php if (count($firstLevelItem['subMenuItems']) > 0) : ?>            
                <ul> 
                    <?php foreach ($firstLevelItem['subMenuItems'] as $secondLevelItem) : ?>

                    <li<?php echo getListItemClass($secondLevelItem, $currentItemDetails); ?>><a href="<?php echo getMenuUrl($secondLevelItem); ?>" id="<?php echo getHtmlId($secondLevelItem); ?>"<?php echo getSubMenuIndication($secondLevelItem); ?>><?php echo __($secondLevelItem['menuTitle']) ?></a>

                        <?php if (count($secondLevelItem['subMenuItems']) > 0) : ?>

                            <ul>

                                <?php foreach ($secondLevelItem['subMenuItems'] as $thirdLevelItem) : ?>

                                    <li><a href="<?php echo getMenuUrl($thirdLevelItem); ?>" id="<?php echo getHtmlId($thirdLevelItem); ?>"><?php echo __($thirdLevelItem['menuTitle']) ?></a></li>

                                <?php endforeach; ?>

                            </ul> <!-- third level -->

                        <?php endif; ?>

                        </li>   
                    
                    <?php endforeach; ?>
                </ul>
            <?php else: 
                // Empty li to add an orange bar and maintain uniform look.
            ?>                        
                        <!-- <li></li> -->
            <?php endif; ?>
                
                 <!-- second level -->                        
            </li>
            
        <?php endforeach; ?>
            
    </ul> <!-- first level -->
    
</div> <!-- menu -->