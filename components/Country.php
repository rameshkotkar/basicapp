<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
 
class Country extends Component
{
    private static $list=false;
    
    public static function model()
    {
        return new Country();
    }
    /* get country List
    *  @return array
    */
    public function getCountryList()
    {
            if(self::$list)
            {
                return self::$list;
            }
            $list=Array(
                "AD" => "Andorra",
                "AE" => "United Arab Emirates",
                "AF" => "Afghanistan",
                "AG" => "Antigua And Barbuda",
                "AI" => "Anguilla",
                "AL" => "Albania",
                "AM" => "Armenia",
                "AN" => "Netherlands Antilles",
                "AO" => "Angola",
                "AQ" => "Antarctica",
                "AR" => "Argentina",
                "AS" => "American Samoa",
                "AT" => "Austria",
                "AU" => "Australia",
                "AW" => "Aruba",
                "AZ" => "Azerbaijan",
                "BA" => "Bosnia And Herzegovina",
                "BB" => "Barbados",
                "BD" => "Bangladesh",
                "BE" => "Belgium",
                "BF" => "Burkina Faso",
                "BG" => "Bulgaria",
                "BH" => "Bahrain",
                "BI" => "Burundi",
                "BJ" => "Benin",
                "BM" => "Bermuda",
                "BN" => "Brunei Darussalam",
                "BO" => "Bolivia",
                "BR" => "Brazil",
                "BS" => "Bahamas",
                "BT" => "Bhutan",
                "BW" => "Botswana",
                "BY" => "Belarus",
                "BZ" => "Belize",
                "CA" => "Canada",
                "CD" => "The Democratic Republic Of The Congo",
                "CF" => "Central African Republic",
                "CG" => "Congo",
                "CH" => "Switzerland",
                "CI" => "Cote D'ivoire",
                "CK" => "Cook Islands",
                "CL" => "Chile",
                "CM" => "Cameroon",
                "CN" => "China",
                "CO" => "Colombia",
                "CR" => "Costa Rica",
                "CS" => "Serbia And Montenegro",
                "CU" => "Cuba",
                "CV" => "Cape Verde",
                "CY" => "Cyprus",
                "CZ" => "Czech Republic",
                "DE" => "Germany",
                "DJ" => "Djibouti",
                "DK" => "Denmark",
                "DM" => "Dominica",
                "DO" => "Dominican Republic",
                "DZ" => "Algeria",
                "EC" => "Ecuador",
                "EE" => "Estonia",
                "EG" => "Egypt",
                "ER" => "Eritrea",
                "ES" => "Spain",
                "ET" => "Ethiopia",
                "EU" => "European Union",
                "FI" => "Finland",
                "FJ" => "Fiji",
                "FK" => "Falkland Islands (Malvinas)",
                "FM" => "Federated States Of Micronesia",
                "FO" => "Faroe Islands",
                "FR" => "France",
                "GA" => "Gabon",
                "GB" => "United Kingdom",
                "GD" => "Grenada",
                "GE" => "Georgia",
                "GF" => "French Guiana",
                "GH" => "Ghana",
                "GI" => "Gibraltar",
                "GL" => "Greenland",
                "GM" => "Gambia",
                "GN" => "Guinea",
                "GP" => "Guadeloupe",
                "GQ" => "Equatorial Guinea",
                "GR" => "Greece",
                "GS" => "South Georgia And The South Sandwich Islands",
                "GT" => "Guatemala",
                "GU" => "Guam",
                "GW" => "Guinea-Bissau",
                "GY" => "Guyana",
                "HK" => "Hong Kong",
                "HN" => "Honduras",
                "HR" => "Croatia",
                "HT" => "Haiti",
                "HU" => "Hungary",
                "ID" => "Indonesia",
                "IE" => "Ireland",
                "IL" => "Israel",
                "IN" => "India",
                "IO" => "British Indian Ocean Territory",
                "IQ" => "Iraq",
                "IR" => "Islamic Republic Of Iran",
                "IS" => "Iceland",
                "IT" => "Italy",
                "JM" => "Jamaica",
                "JO" => "Jordan",
                "JP" => "Japan",
                "KE" => "Kenya",
                "KG" => "Kyrgyzstan",
                "KH" => "Cambodia",
                "KI" => "Kiribati",
                "KM" => "Comoros",
                "KN" => "Saint Kitts And Nevis",
                "KR" => "Republic Of Korea",
                "KW" => "Kuwait",
                "KY" => "Cayman Islands",
                "KZ" => "Kazakhstan",
                "LA" => "Lao People's Democratic Republic",
                "LB" => "Lebanon",
                "LC" => "Saint Lucia",
                "LI" => "Liechtenstein",
                "LK" => "Sri Lanka",
                "LR" => "Liberia",
                "LS" => "Lesotho",
                "LT" => "Lithuania",
                "LU" => "Luxembourg",
                "LV" => "Latvia",
                "LY" => "Libyan Arab Jamahiriya",
                "MA" => "Morocco",
                "MC" => "Monaco",
                "MD" => "Republic Of Moldova",
                "MG" => "Madagascar",
                "MH" => "Marshall Islands",
                "MK" => "The Former Yugoslav Republic Of Macedonia",
                "ML" => "Mali",
                "MM" => "Myanmar",
                "MN" => "Mongolia",
                "MO" => "Macao",
                "MP" => "Northern Mariana Islands",
                "MQ" => "Martinique",
                "MR" => "Mauritania",
                "MT" => "Malta",
                "MU" => "Mauritius",
                "MV" => "Maldives",
                "MW" => "Malawi",
                "MX" => "Mexico",
                "MY" => "Malaysia",
                "MZ" => "Mozambique",
                "NA" => "Namibia",
                "NC" => "New Caledonia",
                "NE" => "Niger",
                "NF" => "Norfolk Island",
                "NG" => "Nigeria",
                "NI" => "Nicaragua",
                "NL" => "Netherlands",
                "NO" => "Norway",
                "NP" => "Nepal",
                "NR" => "Nauru",
                "NU" => "Niue",
                "NZ" => "New Zealand",
                "OM" => "Oman",
                "PA" => "Panama",
                "PE" => "Peru",
                "PF" => "French Polynesia",
                "PG" => "Papua New Guinea",
                "PH" => "Philippines",
                "PK" => "Pakistan",
                "PL" => "Poland",
                "PR" => "Puerto Rico",
                "PS" => "Palestinian Territory",
                "PT" => "Portugal",
                "PW" => "Palau",
                "PY" => "Paraguay",
                "QA" => "Qatar",
                "RE" => "Reunion",
                "RO" => "Romania",
                "RU" => "Russian Federation",
                "RW" => "Rwanda",
                "SA" => "Saudi Arabia",
                "SB" => "Solomon Islands",
                "SC" => "Seychelles",
                "SD" => "Sudan",
                "SE" => "Sweden",
                "SG" => "Singapore",
                "SI" => "Slovenia",
                "SK" => "Slovakia (Slovak Republic)",
                "SL" => "Sierra Leone",
                "SM" => "San Marino",
                "SN" => "Senegal",
                "SO" => "Somalia",
                "SR" => "Suriname",
                "ST" => "Sao Tome And Principe",
                "SV" => "El Salvador",
                "SY" => "Syrian Arab Republic",
                "SZ" => "Swaziland",
                "TD" => "Chad",
                "TF" => "French Southern Territories",
                "TG" => "Togo",
                "TH" => "Thailand",
                "TJ" => "Tajikistan",
                "TK" => "Tokelau",
                "TL" => "Timor-Leste",
                "TM" => "Turkmenistan",
                "TN" => "Tunisia",
                "TO" => "Tonga",
                "TR" => "Turkey",
                "TT" => "Trinidad And Tobago",
                "TV" => "Tuvalu",
                "TW" => "Taiwan Province Of China",
                "TZ" => "United Republic Of Tanzania",
                "UA" => "Ukraine",
                "UG" => "Uganda",
                "US" => "United States",
                "UY" => "Uruguay",
                "UZ" => "Uzbekistan",
                "VA" => "Holy See (Vatican City State)",
                "VC" => "Saint Vincent And The Grenadines",
                "VE" => "Venezuela",
                "VG" => "Virgin Islands",
                "VI" => "Virgin Islands",
                "VN" => "Viet Nam",
                "VU" => "Vanuatu",
                "WS" => "Samoa",
                "YE" => "Yemen",
                "YT" => "Mayotte",
                "YU" => "Serbia And Montenegro (Formally Yugoslavia)",
                "ZA" => "South Africa",
                "ZM" => "Zambia",
                "ZW" => "Zimbabwe",
                "ZZ" => "Reserved",
        );
        self::$list=$list;
        return self::$list;
    }
 
}