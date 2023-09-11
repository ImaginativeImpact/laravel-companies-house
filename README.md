
[![Latest Version on Packagist](https://img.shields.io/packagist/v/imaginativeimpact/laravel-companies-house.svg?style=flat-square)](https://packagist.org/packages/imaginativeimpact/laravel-companies-house)
[![Total Downloads](https://img.shields.io/packagist/dt/imaginativeimpact/laravel-companies-house.svg?style=flat-square)](https://packagist.org/packages/imaginativeimpact/laravel-companies-house)

# Laravel Companies House

A Laravel package for reading Companies House.

# Documentation and install instructions

Companies House API documentation can be found at:
https://developer.company-information.service.gov.uk/api/docs/

## Application Register

To use the Companies House API, an application needs to be created at https://developer.companieshouse.gov.uk/developer/applications

## Install

Take a note of the API key and add it to your .env file

```
COMPANIES_HOUSE_KEY=
```

Via Composer

```
composer require imaginativeimpact/laravel-companies-house
```

You can publish the config file with:

```php
php artisan vendor:publish --provider="ImaginativeImpact/LaravelCompaniesHouse/CompaniesHouseServiceProvider" --tag="config"
```

When published, the config/companieshouse.php config file contains:

```php
<?php

return [

    /*
    * The API Key from Companies House to identify the application
    * https://developer.companieshouse.gov.uk/developer/applications
    */
    'apiKey' => env('COMPANIES_HOUSE_API_KEY'),
];
```

## Usage

In a controller import the class:

```
use ImaginativeImpact\LaravelCompaniesHouse\Facades\CompaniesHouse;
```

In a view or closure call the facade:

```php
CompaniesHouse::get('path');
```

You call CompaniesHouse followed by get:: this will run a GET request followed by the endpoint you want to call, for instance, to call company profile (https://developer.companieshouse.gov.uk/api/docs/company/company_number/company_number.html)

```php
CompaniesHouse::get('company/123456');
```

Each function provides convenient methods that call the endpoints, processes the data, and returns JSON of the results.

## Search

Search across all indexed information.

```php
CompaniesHouse::search($term);
```

Search companies

```php
CompaniesHouse::searchCompany($term);
```

Search companies alphabetically

```php
CompaniesHouse::searchCompaniesAlphabetic($term, $searchAbove, $searchBelow);
```

Search companies advanced

```php
searchCompaniesAdvanced($companyNameIncludes, $companyNameExcludes, $companyStatuses, $companySubtypes, $companyTypes, $dissolvedFrom, $dissolvedTo, $incorporatedFrom, $incorporatedTo, $location, $sicCodes);
```

Search Officer

```php
CompaniesHouse::searchOfficer($term);
```

Search disqualified officers

```php
CompaniesHouse::searchOfficerDisqualified($term);
```

Search dissolved companies

```php
CompaniesHouse::searchDissolvedCompanies($term);
```

## Companies

Get Company

```php
CompaniesHouse::getCompany($companyNumber);
```

Get Company Address

```php
CompaniesHouse::getCompanyRegisteredOfficeAddress($companyNumber);
```

Get Company Officer

```php
CompaniesHouse::getCompanyOfficer($companyNumber);
```

Get Company Filing

```php
CompaniesHouse::getCompanyFilingHistory($companyNumber);
```

Get Company Filing Item

```php
CompaniesHouse::getCompanyFilingHistoryItem($companyNumber);
```

Get Company Insolvency

```php
CompaniesHouse::getCompanyInsolvency($companyNumber);
```

Get Company Charges

```php
CompaniesHouse::getCompanyCharges($companyNumber);
```

Get Company Charges Item

```php
CompaniesHouse::getCompanyChargesItem($companyNumber);
```

Get Company UK Establishments

```php
CompaniesHouse::getCompanyUkEstablishments($companyNumber);
```

Get Company Registers

```php
CompaniesHouse::getCompanyRegisters($companyNumber);
```

Get Company Exemptions

```php
CompaniesHouse::getCompanyExemptions($companyNumber);
```

Get Company Corporate Beneficial Owner

```php
CompaniesHouse::getCompanyCorporateEntityBeneficialOwner($companyNumber, $pscId);
```

Get Company Corporate Entity With Significant Control

```php
CompaniesHouse::getCompanyCorporateEntityWithSignificantControl($companyNumber, $pscId);
```

Get Company Individual Beneficial Owner

```php
CompaniesHouse::getCompanyIndividualBeneficialOwner($companyNumber, $pscId);
```

Get Company Individual Person With Significant Control

```php
CompaniesHouse::getCompanyIndividualPersonWithSignificantControl($companyNumber, $pscId);
```

Get Company Legal Person Beneficial Owner

```php
CompaniesHouse::getCompanyLegalPersonBeneficialOwner($companyNumber, $pscId);
```

Get Company Legal Person With Significant Control

```php
CompaniesHouse::getCompanyLegalPersonWithSignificantControl($companyNumber, $pscId);
```

Get Company Super Secure Beneficial Owner

```php
CompaniesHouse::getCompanySuperSecureBeneficialOwner($companyNumber, $superSecureId);
```

Get Company Super Secure Person With Significant Control

```php
CompaniesHouse::getCompanySuperSecurePersonWithSignificantControl($companyNumber, $superSecureId);
```

Get Company Persons With Significant Control

```php
CompaniesHouse::getCompanyPersonsWithSignificantControl($companyNumber);
```

Get Company Persons With Significant Control Statements

```php
CompaniesHouse::getCompanyPersonsWithSignificantControlStatements($companyNumber);
```

Get Company Persons With Significant Control Statement

```php
CompaniesHouse::getCompanyPersonWithSignificantControlStatement($companyNumber, $statementId);
```

## Officer

Get Officer Appointments

```php
CompaniesHouse::getOfficerAppointments($officerId);
```

Get Officer Disqualifications Natural

```php
CompaniesHouse::getOfficerDisqualificationsNatural($officerId);
```

Get Officer Disqualification Corporate

```php
CompaniesHouse::getOfficerDisqualificationsCorporate($officerId);
```

## Contributing

Contributions are welcome and will be fully credited.

Contributions are accepted via Pull Requests on [Github](https://github.com/imaginativeimpact/laravel-companies-house).

## Pull Requests

- **Document any change in behaviour** - Make sure the `README.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle** - We try to follow [SemVer v2.0.0](http://semver.org/). Randomly breaking public APIs is not an option.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

## Security

If you discover any security related issues, please email security@imaginativeimpact.com instead of using the issue tracker.

## License

MIT license. Please see the [license file](LICENSE) for more information.