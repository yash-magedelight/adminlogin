<?php

namespace Krish\Adminlogin\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    private $remoteAddress;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remoteAddress)
    {
        parent::__construct($context);
        $this->remoteAddress = $remoteAddress;
    }

    /**
     * @param $config
     * @return mixed
     */
    public function getConfig($config)
    {
        return $this->scopeConfig->getValue($config, ScopeInterface::SCOPE_STORE);
    }

    public function isEnable()
    {
        return (bool) $this->getConfig('krish_adminlogin/general/enable');
    }

    public function getUsername()
    {
        return $this->getConfig('krish_adminlogin/general/username');
    }

    public function getPassword()
    {
        return $this->getConfig('krish_adminlogin/general/password');
    }

    public function getAllowedIps()
    {
        $allowedIps = $this->getConfig('krish_adminlogin/general/allowed_ips');
        $allowedIps = explode(',', $allowedIps);
        $allowedIps = array_map('trim', $allowedIps);

        return $allowedIps;
    }

    public function isAllowedIp() : bool
    {
        $allowedIps = $this->getAllowedIps();
        $isEnable = $this->isEnable();

        if(!$isEnable)
        {
            return false;
        }
        else if(in_array($this->getCurrentIp(), $allowedIps))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getCurrentIp()
    {
        return $this->remoteAddress->getRemoteAddress();
    }
}