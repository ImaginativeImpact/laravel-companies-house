<?php

namespace ImaginativeImpact\LaravelCompaniesHouse;

use GuzzleHttp\Client;
use Exception;
use ImaginativeImpact\LaravelCompaniesHouse\Traits\GuzzleClientTrait;

class CompaniesHouse {

    use GuzzleClientTrait;

    /**
     * Search All
     * @param $term
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search($term)
    {
        return self::guzzle('search?q='.$term);
    }

    /**
     * Search Companies
     * @param $term
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchCompanies($term)
    {
        return self::guzzle('search/companies?q='.$term);
    }

    /**
     * Search for a Company alphabetically
     * @param $term
     * @param $searchAbove
     * @param $searchBelow
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchCompaniesAlphabetic($term, $searchAbove = null, $searchBelow = null)
    {
        return self::guzzle('alphabetic-search/companies?q='.$term.($searchAbove??"&searchAbove=$searchAbove").($searchBelow??"&searchBelow=$searchBelow"));
    }

    /**
     * Advanced search for a Company
     * @param String|null $companyNameIncludes
     * @param String|null $companyNameExcludes
     * @param array|null $companyStatuses
     * @param array|null $companySubtypes
     * @param array|null $companyTypes
     * @param String|null $dissolvedFrom
     * @param String|null $dissolvedTo
     * @param String|null $incorporatedFrom
     * @param String|null $incorporatedTo
     * @param String|null $location
     * @param array|null $sicCodes
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchCompaniesAdvanced(
        String $companyNameIncludes = null,
        String $companyNameExcludes = null,
        Array $companyStatuses = null,
        Array $companySubtypes = null,
        Array $companyTypes = null,
        String $dissolvedFrom = null,
        String $dissolvedTo = null,
        String $incorporatedFrom = null,
        String $incorporatedTo = null,
        String $location = null,
        Array $sicCodes = null
    )
    {
        $paramsArray = [];
        if($companyNameIncludes) { $paramsArray[] = ['company_name_includes' => $companyNameIncludes]; }
        if($companyNameExcludes) { $paramsArray[] = ['company_name_excludes' => $companyNameExcludes]; }
        if($companyStatuses) { $paramsArray[] = ['company_status' => implode(',', $companyStatuses)]; }
        if($companySubtypes) { $paramsArray[] = ['company_subtype' => implode(',', $companySubtypes)]; }
        if($companyTypes) { $paramsArray[] = ['company_type' => implode(',', $companyTypes)]; }
        if($dissolvedFrom) { $paramsArray[] = ['dissolved_from' => $dissolvedFrom]; }
        if($dissolvedTo) { $paramsArray[] = ['dissolved_to' => $dissolvedTo]; }
        if($incorporatedFrom) { $paramsArray[] = ['incorporated_from' => $incorporatedFrom]; }
        if($incorporatedTo) { $paramsArray[] = ['incorporated_to' => $incorporatedTo]; }
        if($location) { $paramsArray[] = ['location' => $location]; }
        if($sicCodes) { $paramsArray[] = ['sic_code' => implode(',', $sicCodes)]; }

        $paramsQuery = '';
        foreach($paramsArray as $key => $value) {
            if(empty($paramsQuery)) {
                $paramsQuery .= "?$key=$value";
            } else {
                $paramsQuery .= "&$key=$value";
            }
        }

        return self::guzzle('advanced-search/companies?'.$paramsQuery);
    }

    /**
     * Search Company Officers
     * @param $term
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchOfficers($term)
    {
        return self::guzzle('search/officers?q='.$term);
    }

    /**
     * Search disqualified officers
     * @param $term
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchDisqualifiedOfficers($term)
    {
        return self::guzzle('search/disqualified-officers?q='.$term);
    }

    /**
     * Search dissolved companies
     * @param $term
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchDissolvedCompanies($term)
    {
        return self::guzzle('dissolved-search/companies?q='.$term);
    }


    /**
     * Get the basic company information
     * @param $companyNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompany($companyNumber)
    {
        return self::guzzle('company/'.$companyNumber);
    }

    /**
     * Get the current address of a company
     * @param $companyNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyRegisteredOfficeAddress($companyNumber)
    {
        return self::guzzle('company/'.$companyNumber.'/registered-office-address');
    }

    /**
     * List of all company officers
     * @param $companyNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyOfficers($companyNumber)
    {
        return self::guzzle('company/'.$companyNumber.'/officers');
    }

    /**
     * Get the filing history list of a company
     * @param $companyNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyFilingHistory($companyNumber)
    {
        return self::guzzle('company/'.$companyNumber.'/filing-history');
    }

    /**
     * Get the filing history item of a company
     * @param $companyNumber
     * @param $transactionID
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyFilingHistoryItem($companyNumber, $transactionID)
    {
        return self::guzzle('company/'.$companyNumber.'/filing-history/'.$transactionID);
    }

    /**
     * Company insolvency information
     * @param $companyNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyInsolvency($companyNumber)
    {
        return self::guzzle('company/'.$companyNumber.'/insolvency');
    }

    /**
     * List of charges for a company.
     * @param $companyNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyCharges($companyNumber)
    {
        return self::guzzle('company/'.$companyNumber.'/charges');
    }

    /**
     * Individual charge information for company.
     * @param $companyNumber
     * @param $chargeId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyChargesItem($companyNumber, $chargeId)
    {
        return self::guzzle('company/'.$companyNumber.'/charges/'.$chargeId);
    }

    /**
     * List of uk-establishments companies
     * @param $companyNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyUkEstablishments($companyNumber)
    {
        return self::guzzle('company/'.$companyNumber.'/uk-establishments');
    }

    /**
     * Get the company registers information
     * @param $companyNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyRegisters($companyNumber)
    {
        return self::guzzle('company/'.$companyNumber.'/registers');
    }

    /**
     * Company exemptions information
     * @param $companyNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyExemptions($companyNumber)
    {
        return self::guzzle('company/'.$companyNumber.'/exemptions');
    }

    /**
     * Get details of an individual company officer appointment
     * @param $officerId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOfficerAppointments($officerId)
    {
        return self::guzzle('officers/'.$officerId.'/appointments');
    }

    /**
     * Get natural officers disqualifications
     * @param $officerId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOfficerDisqualificationsNatural($officerId)
    {
        return self::guzzle('/disqualified-officers/natural/'.$officerId);
    }

    /**
     * Get a corporate officers disqualifications
     * @param $officerId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOfficerDisqualificationsCorporate($officerId)
    {
        return self::guzzle('/disqualified-officers/corporate/'.$officerId);
    }

    /**
     * Get details of a corporate entity beneficial owner
     * @param $companyNumber
     * @param $pscId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyCorporateEntityBeneficialOwner($companyNumber, $pscId)
    {
        return self::guzzle('/company/'.$companyNumber.'/persons-with-significant-control/corporate-entity-beneficial-owner/'.$pscId);
    }

    /**
     * Get details of a corporate entity with significant control
     * @param $companyNumber
     * @param $pscId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyCorporateEntityWithSignificantControl($companyNumber, $pscId)
    {
        return self::guzzle('/company/'.$companyNumber.'/persons-with-significant-control/corporate-entity/'.$pscId);
    }

    /**
     * Get details of an individual beneficial owner
     * @param $companyNumber
     * @param $pscId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyIndividualBeneficialOwner($companyNumber, $pscId)
    {
        return self::guzzle('/company/'.$companyNumber.'/persons-with-significant-control/individual-beneficial-owner/'.$pscId);
    }

    /**
     * Get details of an individual person with significant control
     * @param $companyNumber
     * @param $pscId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyIndividualPersonWithSignificantControl($companyNumber, $pscId)
    {
        return self::guzzle('/company/'.$companyNumber.'/persons-with-significant-control/individual/'.$pscId);
    }

    /**
     * Get details of a legal person beneficial owner
     * @param $companyNumber
     * @param $pscId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyLegalPersonBeneficialOwner($companyNumber, $pscId)
    {
        return self::guzzle('/company/'.$companyNumber.'/persons-with-significant-control/legal-person-beneficial-owner/'.$pscId);
    }

    /**
     * Get details of a legal person with significant control
     * @param $companyNumber
     * @param $pscId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyLegalPersonWithSignificantControl($companyNumber, $pscId)
    {
        return self::guzzle('/company/'.$companyNumber.'/persons-with-significant-control/legal-person/'.$pscId);
    }

    /**
     * Get details of a super secure beneficial owner
     * @param $companyNumber
     * @param $superSecureId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanySuperSecureBeneficialOwner($companyNumber, $superSecureId)
    {
        return self::guzzle('/company/'.$companyNumber.'/persons-with-significant-control/super-secure-beneficial-owner/'.$superSecureId);
    }

    /**
     * Get details of a super secure person with significant control
     * @param $companyNumber
     * @param $superSecureId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanySuperSecurePersonWithSignificantControl($companyNumber, $superSecureId)
    {
        return self::guzzle('/company/'.$companyNumber.'/persons-with-significant-control/super-secure/'.$superSecureId);
    }

    /**
     * List of all persons with significant control (not statements)
     * @param $companyNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyPersonsWithSignificantControl($companyNumber)
    {
        return self::guzzle('/company/'.$companyNumber.'/persons-with-significant-control');
    }

    /**
     * List of all persons with significant control statements
     * @param $companyNumber
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyPersonsWithSignificantControlStatements($companyNumber)
    {
        return self::guzzle('/company/'.$companyNumber.'/persons-with-significant-control-statements');
    }

    /**
     * Get details of a person with significant control statement
     * @param $companyNumber
     * @param $statementId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyPersonWithSignificantControlStatement($companyNumber, $statementId)
    {
        return self::guzzle('/company/'.$companyNumber.'/persons-with-significant-control-statements/'.$statementId);
    }

}