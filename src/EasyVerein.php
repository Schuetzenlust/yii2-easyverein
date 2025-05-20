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

    public function getMembers($params = [])
    {
        return $this->_client->get('mitglied/', $params);
    }

    public function getMember($id)
    {
        return $this->_client->get("mitglied/{$id}/");
    }

    public function createMember($data)
    {
        return $this->_client->post("mitglied/", $data);
    }

    public function updateMember($id, $data)
    {
        return $this->_client->put("mitglied/{$id}/", $data);
    }

    public function deleteMember($id)
    {
        return $this->_client->delete("mitglied/{$id}/");
    }
}
