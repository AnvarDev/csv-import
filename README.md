# CSV/Import

In the project directory, you can run with Access Key as KEY of the ip service ipstack.com:

### `KEY=*** php -S localhost:8021`

Runs the app in the development server.<br />
Open [http://localhost:8021](http://localhost:8021) to view it in the browser.

### Requirements

- PHP version: ^7.4
- CSV file columns structure: Customer ID (A), Call Date (B), Duration in seconds (C), Dialed Phone Number (D), Customer IP that initiated the call (E). 

**Note: For phone numbers used Geonames which DB is parsed from [https://download.geonames.org/export/dump/countryInfo.txt](https://download.geonames.org/export/dump/countryInfo.txt) as geonames.json.**
