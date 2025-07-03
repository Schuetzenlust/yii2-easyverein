<?php
namespace schuetzenlust\easyverein\types;

class ContactDetails
{
	public ?string $id = null;
	public ?string $privateEmail = null;
	public ?string $companyEmail = null;
	public bool $_isCompany = false;
	public ?int $methodOfPaymentName = null;
	public ?string $salutation = null;
	public ?string $firstName = null;
	public ?string $familyName = null;
	public ?string $nameAffix = null;
	public ?string $dateOfBirth = null;
	public ?int $_preferredEmailField = null;
	public ?int $preferredCommunicationWay = null;
	public ?string $companyName = null;
	public bool $invoiceCompany = false;
	public bool $sendInvoiceCompanyMail = false;
	public ?string $companyEmailInvoice = null;
	public bool $addressCompany = false;
	public ?string $privatePhone = null;
	public ?string $companyPhone = null;
	public ?string $mobilePhone = null;
	public ?string $street = null;
	public ?string $city = null;
	public ?string $state = null;
	public ?string $zip = null;
	public ?string $country = null;
	public ?string $companyStreet = null;
	public ?string $companyCity = null;
	public ?string $companyState = null;
	public ?string $companyZip = null;
	public ?string $companyCountry = null;
	public ?string $companyNameInvoice = null;
	public ?string $companyStreetInvoice = null;
	public ?string $companyCityInvoice = null;
	public ?string $companyStateInvoice = null;
	public ?string $companyZipInvoice = null;
	public ?string $companyCountryInvoice = null;
	public ?string $companyAddressSuffixInvoice = null;
	public ?string $companyPhoneInvoice = null;
	public ?string $professionalRole = null;
	public ?float $balance = null;
	public ?string $iban = null;
	public ?string $bic = null;
	public ?string $internalNote = null;
	public ?string $bankAccountOwner = null;
	public ?string $sepaMandate = null;
	public ?string $sepaDate = null;
	public ?int $methodOfPayment = null;
	public ?int $datevAccountNumber = null;
	public ?string $_copiedFromParentStartDate = null;
	public ?string $_copiedFromParentEndDate = null;
	public ?string $_copiedFromParentEndDateAction = null;
	public ?string $addressSuffix = null;
	public ?string $companyAddressSuffix = null;
	public ?string $primaryEmail = null;

	/**
	 * Erzeugt ein ContactDetails-Objekt aus einem assoziativen Array.
	 */
	public static function fromArray(array $data): self
	{
		$obj = new self();
		foreach ($data as $key => $value) {
			if (property_exists($obj, $key)) {
				$obj->$key = $value;
			}
		}
		return $obj;
	}
	
	public function toArray(): array
	{
		return get_object_vars($this);
	}
}
