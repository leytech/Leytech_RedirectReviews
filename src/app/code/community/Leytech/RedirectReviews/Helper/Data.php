<?php
/**
 * @package    Leytech_RedirectReviews
 * @author     Chris Nolan (chris@leytech.co.uk)
 * @copyright  Copyright (c) 2017 Leytech
 * @license    https://opensource.org/licenses/MIT  The MIT License  (MIT)
 */

class Leytech_RedirectReviews_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_IS_ENABLED = 'leytech_redirectreviews/settings/enabled';
    const XML_PATH_REDIRECT_LIST = 'leytech_redirectreviews/settings/redirect_list';
    const XML_PATH_REDIRECT_VIEW = 'leytech_redirectreviews/settings/redirect_view';

    public function isEnabled() {
        return (bool)Mage::getStoreConfig(self::XML_PATH_IS_ENABLED);
    }

    public function redirectList() {
        return (bool)Mage::getStoreConfig(self::XML_PATH_REDIRECT_LIST);
    }

    public function redirectView() {
        return (bool)Mage::getStoreConfig(self::XML_PATH_REDIRECT_VIEW);
    }

}