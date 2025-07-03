<?php
namespace schuetzenlust\easyverein\types;

class Member
{
	public ?string $joinDate = null;
	public ?string $resignationDate = null;
	public ?string $resignationNoticeDate = null;
	public ?string $declarationOfApplication = null;
	public ?string $_paymentStartDate = null;
	public $paymentAmount = null; // kann Float, String oder null sein – ggf. als float casten
	public ?int $paymentIntervallMonths = null;
	public ?string $_relatedMember = null; // Link oder null
	public bool $useBalanceForMembershipFee = false;
	public bool $bulletinBoardNewPostNotification = false;
	public array $integrationDosbSport = []; // Liste von Strings oder IDs
	public ?string $integrationDosbGender = null;
	public array $integrationLsbSport = [];
	public ?string $integrationLsbGender = null;
	public bool $_isApplication = false;
	public ?string $membershipNumber = null;
	public array $relatedMembers = []; // IDs oder Ressourcen-Links
	public array $org = []; // API-Link zur Organisation
	public ?int $id = null;
	public ?string $model = null;
	public ?string $_deleteAfterDate = null;
	public ?string $_deletedBy = null;
	public ?string $declarationOfResignation = null;
	public ?string $declarationOfConsent = null;
	public ?string $sepaMandateFile = null;
	public ?string $memberGroups = null; // API-Link
	public $customFields = null; // könnte array oder object sein – ggf. spezifizieren
	public ?string $_applicationDate = null;
	public ?string $_applicationWasAcceptedAt = null;
	public bool $_isChairman = false;
	public ?string $_chairmanPermissionGroup = null;
	public ?string $_profilePicture = null;
	public array $contactDetails = []; // API-Link oder ContactDetails-Objekt
	public ?string $emailOrUserName = null;
	public ?string $signatureText = null;
	public bool $_editableByRelatedMembers = false;
	public bool $requirePasswordChange = false;
	public bool $_isBlocked = false;
	public ?string $blockReason = null;
	public ?string $wantsToCancelAt = null;
	public ?string $cancelReason = null;
	public bool $showWarningsAndNotesToAdminsInProfile = true;
	public $applicationForm = null; // unbekannt – ggf. ID oder Link

	/**
	 * Erzeugt ein Member-Objekt aus einem Array (z. B. JSON-API-Antwort)
	 */
	public static function fromArray(array $data): self
	{
		$obj = new self();
		foreach ($data as $key => $value) {
			if ($key === 'contactDetails' && is_array($value)) {
				$obj->contactDetails = array_map(fn($cd) => ContactDetails::fromArray($cd), $value);
			} elseif (property_exists($obj, $key)) {
				$obj->$key = $value;
			}
		}
		return $obj;
	}
	
	public function toArray(): array
	{
		$data = get_object_vars($this);
		$data['contactDetails'] = array_map(
			fn($cd) => $cd instanceof ContactDetails ? $cd->toArray() : $cd,
			$this->contactDetails
		);
		return $data;
	}
}
