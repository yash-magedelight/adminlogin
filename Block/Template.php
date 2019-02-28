<?php
/**
 * Copyright © Krish, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Krish\Adminlogin\Block;

class Template extends \Magento\Backend\Block\Template
{
	private $helper;

	public function __construct(\Magento\Backend\Block\Template\Context $context, 
		\Krish\Adminlogin\Helper\Data $helper,
		array $data = [])
    {
        $this->_localeDate = $context->getLocaleDate();
        $this->_authorization = $context->getAuthorization();
        $this->mathRandom = $context->getMathRandom();
        $this->_backendSession = $context->getBackendSession();
        $this->formKey = $context->getFormKey();
        $this->nameBuilder = $context->getNameBuilder();
        parent::__construct($context, $data);

        $this->helper = $helper;
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if(!$this->helper->isAllowedIp())
        {
        	$this->setTemplate('Magento_Backend::admin/login.phtml');
        }

        return $this;
    }

    public function getUsername()
    {
        return $this->helper->getUsername();
    }

    public function getPassword()
    {
        return $this->helper->getPassword();   
    }
}