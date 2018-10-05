<?php
/**
 * @package    Leytech_RedirectReviews
 * @author     Chris Nolan (chris@leytech.co.uk)
 * @copyright  Copyright (c) 2017 Leytech
 * @license    https://opensource.org/licenses/MIT  The MIT License  (MIT)
 */

class Leytech_RedirectReviews_Model_Observer
{
    public function redirectReviewListToProduct(Varien_Event_Observer $observer)
    {
        $helper = Mage::helper('leytech_redirectreviews');

        // Do nothing if module is not active
        if (!$helper->isEnabled()) {
            return $this;
        }

        // Do nothing if redirect list is not enabled
        if (!$helper->redirectList()) {
            return $this;
        }

        $request = $observer->getControllerAction()->getRequest();
        /* @var $request Mage_Core_Controller_Request_Http */

        //log to custom logfile
        //Mage::log($request->getServer('HTTP_REFERER').': '.$request->getPathInfo(), Zend_Log::INFO, 'review_redirects.log',true);

        // $toUrl will be empty if missing id param or invalid product ID.
        $toUrl = Mage::getModel('catalog/product')->load($request->getParam('id'))->getProductUrl();

        if (!$toUrl) {
            $request->initForward();
            $request->setActionName('noroute')->setDispatched(false);
        } else {
            Mage::app()->getResponse()->setRedirect($toUrl, 301)->sendResponse();
        }
    }

    public function redirectReviewViewToProduct(Varien_Event_Observer $observer)
    {
        $helper = Mage::helper('leytech_redirectreviews');

        // Do nothing if module is not active
        if (!$helper->isEnabled()) {
            return $this;
        }

        // Do nothing if redirect view is not enabled
        if (!$helper->redirectView()) {
            return $this;
        }

        $request = $observer->getControllerAction()->getRequest();
        /* @var $request Mage_Core_Controller_Request_Http */

        // log to custom logfile
        //Mage::log($request->getServer('HTTP_REFERER').': '.$request->getPathInfo(), Zend_Log::INFO, 'review_redirects.log',true);

        // Load the review to get the product ID.
        $product_id = Mage::getModel('review/review')->load($request->getParam('id'))->getData('entity_pk_value');

        // $toUrl will be empty if missing id param or invalid product ID.
        $toUrl = Mage::getModel('catalog/product')->load($product_id)->getProductUrl();

        if (!$toUrl) {
            $request->initForward();
            $request->setActionName('noroute')->setDispatched(false);
        } else {
            Mage::app()->getResponse()->setRedirect($toUrl, 301)->sendResponse();
        }
    }
}