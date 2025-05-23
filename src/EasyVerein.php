<?php
namespace schuetzenlust\easyverein;

use yii\base\Component;

class EasyVerein extends Component
{
    public $apiToken;
    private $_client;

    public function init()
    {
        parent::init();
        if (!$this->apiToken) {
            throw new \Exception('API Token must be set.');
        }
        $this->_client = new Client($this->apiToken);
    }

    public function getContactDetails($params = [])
    {
        return $this->_client->get('contact-details/', $params);
    }

    public function getContactDetail($id)
    {
        return $this->_client->get('contact-details/{$id}/');
    }

    /*
    ---------------------------------------------------------------
    */

    public function getMembers($params = [])
    {
        return $this->_client->get('member/', $params);
    }

    public function getMember($id)
    {
        return $this->_client->get("member/{$id}/?query={id,contactDetails{id,name},org{id,name,short},emailOrUserName,membershipNumber}");
    }

    public function createMember($data)
    {
        return $this->_client->post("member/", $data);
    }

    public function updateMember($id, $data)
    {
        return $this->_client->put("member/{$id}/", $data);
    }

    public function deleteMember($id)
    {
        return $this->_client->delete("member/{$id}/");
    }
}
