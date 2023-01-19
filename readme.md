# Component POC Html2Pdf
Some usage with [Html2Pdf](https://www.html2pdf.fr).

> HTML2PDF is a HTML to PDF converter written in PHP. It allows the conversion of valid HTML 4.01 in PDF format, and is distributed under OSL. This library has been designed to handle mainly TABLE intertwined to generate invoices delivery,
and other official documents. It does not yet have all the tags.

Additional ressources:
* [official examples](https://github.com/spipu/html2pdf/tree/master/examples)


## Prerequisite
* PHP 7.4 / 8 (v1.0)

## Install
`composer install`

Or you can add this poc like a dependency, in this case edit your [composer.json](https://getcomposer.org) (launch `composer update` after edit):
```json
{
  "repositories": [
    { "type": "git", "url": "git@github.com:jgauthi/poc_pdf_html2pdf.git" }
  ],
  "require": {
    "jgauthi/poc_Html2Pdf": "1.*"
  }
}
```

## Usage
You can test with php internal server and go to url <http://localhost:8000>:

```shell script
php -S localhost:8000 -t public
```


## Documentation
You can look at [folder public](public).

