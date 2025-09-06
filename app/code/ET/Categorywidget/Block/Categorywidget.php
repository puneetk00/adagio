<?php

namespace ET\Categorywidget\Block;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Categorywidget extends Template implements BlockInterface {

    public function _toHtml() {

        $widgetTemplate = 'categorywidget.phtml';
        $demoVersion = $this->getData('demo_version');
        if ($demoVersion == 1) {
            $widgetTemplate = 'categorywidget.phtml';
        } else if ($demoVersion == 2) {
            $widgetTemplate = 'categorywidget2.phtml';
        } else if ($demoVersion == 3) {
            $widgetTemplate = 'categorywidget3.phtml';
        } else if ($demoVersion == 4) {
            $widgetTemplate = 'categorywidget4.phtml';
        } else if ($demoVersion == 5) {
            $widgetTemplate = 'categorywidget5.phtml';
        } else if ($demoVersion == 6) {
            $widgetTemplate = 'categorywidget6.phtml';
        } else if ($demoVersion == 7) {
            $widgetTemplate = 'categorywidget7.phtml';
        } else if ($demoVersion == 8) {
            $widgetTemplate = 'categorywidget8.phtml';
        } else if ($demoVersion == 9) {
            $widgetTemplate = 'categorywidget9.phtml';
        } else if ($demoVersion == 10) {
            $widgetTemplate = 'categorywidget10.phtml';
        } else if ($demoVersion == 11) {
            $widgetTemplate = 'categorywidget11.phtml';
        } else if ($demoVersion == 12) {
            $widgetTemplate = 'categorywidget12.phtml';
        } else if ($demoVersion == 13) {
            $widgetTemplate = 'categorywidget13.phtml';
        } else if ($demoVersion == 14) {
            $widgetTemplate = 'categorywidget14.phtml';
        } else if ($demoVersion == 15) {
            $widgetTemplate = 'categorywidget15.phtml';
        } else if ($demoVersion == 16) {
            $widgetTemplate = 'categorywidget16.phtml';
        } else if ($demoVersion == 17) {
            $widgetTemplate = 'categorywidget17.phtml';
        } else if ($demoVersion == 18) {
            $widgetTemplate = 'categorywidget18.phtml';
        } else if ($demoVersion == 19) {
            $widgetTemplate = 'categorywidget19.phtml';
        } else if ($demoVersion == 20) {
            $widgetTemplate = 'categorywidget20.phtml';
        } else if ($demoVersion == 21) {
            $widgetTemplate = 'categorywidget21.phtml';
        } else if ($demoVersion == 22) {
            $widgetTemplate = 'categorywidget22.phtml';
        }

        $this->setTemplate('widget/' . $widgetTemplate);
        return parent::_toHtml();
    }

}
