# IBAN Field for Craft CMS 3.x

![Icon](resources/iban.png)

A field for storing, validating and formatting IBAN codes.

## Background

"The International Bank Account Number (IBAN) is an internationally agreed system of identifying bank accounts across national borders to facilitate the communication and processing of cross border transactions with a reduced risk of transcription errors." ([Wikipedia](https://en.wikipedia.org/wiki/International_Bank_Account_Number)).

This plugin adds a field type to store and validate IBAN codes. It provides a Twig extension to format IBANs in different formats. 

## Requirements

 * Craft CMS >= 3.0.0

## Installation

Open your terminal and go to your Craft project:

``` shell
cd /path/to/project
composer require codemonauts/craft-iban-field
./craft install/plugin iban
```

## Usage

After installation, the control panel can be used to create IBAN fields.

## Twig Filter

You can use the `|iban` filter to format an IBAN code in different ways. The default is `print`:

```twig
{{ entry.myIban|iban }}
{# Output: "DE89 3704 0044 0532 0130 00" #}

{{ entry.myIban|iban('print') }}
{# Output: "DE89 3704 0044 0532 0130 00" #}

{{ entry.myIban|iban('electronic') }}
{# Output: "DE89370400440532013000" #}

{{ entry.myIban|iban('anonymized') }}
{# Output: "XXXXXXXXXXXXXXXXXX3000" #}
```

With ❤ by [codemonauts](https://codemonauts.com)
