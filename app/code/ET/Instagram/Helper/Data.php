<?php

namespace ET\Instagram\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    /**
     * @var \Magento\Framework\HTTP\Client\Curl
     */
    protected $_curl;

    public function __construct(
    \Magento\Framework\App\Helper\Context $context, \Magento\Framework\HTTP\Client\Curl $curl
    ) {
        $this->_curl = $curl;
        parent::__construct($context);
    }

    public function getInstaData($appAccessToken = '') {
        if ($appAccessToken != '') {

            $url = 'https://graph.instagram.com/me/media?fields=id,caption,media_type,media_url,permalink&access_token=' . $appAccessToken;

            $this->_curl->get($url);
            $response = $this->_curl->getBody();
            $res = json_decode($response);

            if (isset($res->error->code)) {
                return false;
            } else {
                return $res->data;
            }
        } else {
            return false;
        }
    }

}
