<?php
/**
 * Copyright © Krish, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Krish\Adminlogin\Block\Adminhtml\Form\Field;

class CurrentIp extends \Magento\Config\Block\System\Config\Form\Field
{
    private $helper;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Krish\Adminlogin\Helper\Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->helper = $helper;
    }

	/**
     * Set template.
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('Krish_Adminlogin::system/form/field/currentip.phtml');
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->_toHtml();
    }

    public function getCurrentIp()
    {
        return $this->helper->getCurrentIp();
    }
}