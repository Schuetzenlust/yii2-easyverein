<?php
namespace schuetzenlust\easyverein;

use yii\base\Component;
use schuetzenlust\easyverein\types\Member;

class EasyVerein extends Component
{
    public $apiToken;
    public $baseUrl;
    private $_client;

    public function init()
    {
        parent::init();
        if (!$this->apiToken) {
            throw new \Exception('API Token must be set.');
        }
        $this->_client = new Client($this->apiToken, $this->baseUrl);
    }
    
    public function setApiToken($token) {
        $this->apiToken = $token;
    }
    
    
    public function getContactDetails($params = [])
    {
        return $this->_client->get('contact-details/', $params);
    }

    public function getContactDetail($id)
    {
        return $this->_client->get("contact-details/{$id}/");
    }
    
    public function createContactDetail($data) {
        return $this->client->post("contact-detail/", $data);
    }
    
    /*
    ---------------------------------------------------------------
    */
    
    public function pureGet($endpoint, $params = []) {
        return $this->_client->get($endpoint, $params);
    }
    
    public function getMembers($params = [])
    {
        return $this->_client->get('member/', $params);
    }
    
    public function getMemberCustomFields($id, $params = []) {
        return $this->_client->get("member/".$id."/custom-fields", $params);
    }
    
    public function getCustomField($id) {
        return $this->_client->get('custom-field/'.$id);
    }
    
    public function getMember($id, $params = ""): ?Member
    {
        $response = $this->_client->get("member/{$id}/", $params);
        if (isset($response['error']) && $response['error']) {
            // Fehlerbehandlung
            return null;
        }
        return Member::fromArray($response);
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
    
    public function getToken(string $username, string $password): array {
        
        return $this->_client->post('get-token/', [
            'username' => "NSL_".$username,
            'password' => $password,
        ]);
    }
    
}
