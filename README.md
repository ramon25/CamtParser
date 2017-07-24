# ongoing CamtParser

A PHP Library to parse Camt.054 Files.

## Installation
Add the repository to your `composer.json`
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://bitbucket.org/ongoing/camt.054-parser"
    }
]
```
Add the library to your project using composer
```
composer require ongoing/camtparser
```

## Usage
- Create a new parser and pass the path to your xml file to it:
 `$parser = new CamtParser('/path/to/your/file.xml');`
- Parse the file:
 `$data = $parser->parse();`
