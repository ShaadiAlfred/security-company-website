/*
 * Parsing jsonc localization file synchronously
 */

const fs = require('fs');
const jsonc = require('jsonc').safe;

const jsoncFilePath = 'resources/lang/ar.jsonc';

const jsoncFile = fs.readFileSync(jsoncFilePath, 'utf-8');

const [parsingError, parsedJsonc] = jsonc.parse(jsoncFile);

if (parsingError) {
    console.log(parsingError.message);
    process.exit()
}

fs.writeFile('resources/lang/ar.json', JSON.stringify(parsedJsonc, null, 2), (error) => {
    if (error) { console.log(error); }
});
