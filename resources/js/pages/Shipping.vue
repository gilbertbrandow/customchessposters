<template>
    <div class="content card">
        <h2>Information</h2>
        <form @submit.prevent="submit()" style="align-self: stretch;">
            <div class="field__wrp">
                <label for="email" class="field__label">Email address</label>
                <div v-if="form.errors.email" v-text="form.errors.email" class="field__error"></div>
                <input v-model="form.email" class="field" :class="{ 'is--error': form.errors.email }" name="email"
                    placeholder="example@email.com" />
            </div>
            <h3 class="is--margin-top">Shipping</h3>
            <div class="field__wrp">
                <label for="country" class="field__label">Country</label>
                <select v-model="form.country" id="country" class="field" name="country">
                    <option :value="null">Country</option>
                    <option v-for="(country, key) in this.countries" :val="key">{{ country }}</option>
                </select>

            </div>
            <div class="row">
                <div class="field__wrp">
                    <label for="firstname" class="field__label">First name</label>
                    <input v-model="form.firstName" class="field" name="firstname" id="firstname" placeholder="Jane" />
                </div>

                <div class="field__wrp">
                    <label for="lastName" class="field__label">Last name</label>
                    <input v-model="form.lastName" class="field" name="lastName" id="lastName" type="text"
                        placeholder="Doe" />
                </div>
            </div>
            <div class="field__wrp">
                <label for="address" class="field__label">Street Address</label>
                <div v-if="form.errors.address" v-text="form.errors.address" class="field__error"></div>
                <input type="address" v-model="form.address" class="field" :class="{ 'is--error': form.errors.address }"
                    name="address" placeholder="19749 Dearborn St" />
            </div>
            <div class="field__wrp">
                <label for="address" class="field__label">Address line 2 (Optional)</label>
                <div v-if="form.errors.address2" v-text="form.errors.address2" class="field__error"></div>
                <input type="address" v-model="form.address2" class="field" :class="{ 'is--error': form.errors.address2 }"
                    name="address2" placeholder="Apt, Suite, Bldg." />
            </div>
            <div class="row">
                <div class="field__wrp">
                    <label for="zipcode" class="field__label">Zip code</label>
                    <input v-model="form.zipCode" class="field" name="firstname" id="zipcode" placeholder="NY 10118" />
                </div>

                <div class="field__wrp">
                    <label for="city" class="field__label">City</label>
                    <input v-model="form.city" class="field" name="city" id="city" type="text" placeholder="New York" />
                </div>
            </div>
            <div class="field__wrp">
                <button :disabled="form.processing"
                    class="button is--black is--less-border-radius is--flex is--space-between">
                    Proceeed To Shipping Alternatives
                    <Icon name="arrow-right" />
                </button>
                <div v-if="form.errors.all" v-text="form.errors.all" class="field__error is--submit"></div>
            </div>
        </form>
    </div>
</template>

<script>
import Checkout from "../Layouts/Checkout.vue";
import { useForm } from '@inertiajs/vue3'
import axios from 'axios'

export default {
    layout: Checkout,

    data() {
        return {
            countries: {
                'AX': 'Aland Islands',
                'AL': 'Albania',
                'DZ': 'Algeria',
                'AS': 'American Samoa',
                'AD': 'Andorra',
                'AO': 'Angola',
                'AI': 'Anguilla',
                'AQ': 'Antarctica',
                'AG': 'Antigua and Barbuda',
                'AR': 'Argentina',
                'AM': 'Armenia',
                'AW': 'Aruba',
                'AU': 'Australia',
                'AT': 'Austria',
                'AZ': 'Azerbaijan',
                'BS': 'Bahamas the',
                'BH': 'Bahrain',
                'BD': 'Bangladesh',
                'BB': 'Barbados',
                'BY': 'Belarus',
                'BE': 'Belgium',
                'BZ': 'Belize',
                'BJ': 'Benin',
                'BM': 'Bermuda',
                'BO': 'Bolivia',
                'BA': 'Bosnia and Herzegovina',
                'BW': 'Botswana',
                'BV': 'Bouvet Island (Bouvetoya)',
                'BR': 'Brazil',
                'IO': 'British Indian Ocean Territory (Chagos Archipelago)',
                'VG': 'British Virgin Islands',
                'BG': 'Bulgaria',
                'BF': 'Burkina Faso',
                'BI': 'Burundi',
                'KH': 'Cambodia',
                'CM': 'Cameroon',
                'CA': 'Canada',
                'CV': 'Cape Verde',
                'KY': 'Cayman Islands',
                'CF': 'Central African Republic',
                'CL': 'Chile',
                'CN': 'China',
                'CX': 'Christmas Island',
                'CC': 'Cocos (Keeling) Islands',
                'CO': 'Colombia',
                'KM': 'Comoros the',
                'CD': 'Congo',
                'CG': 'Congo the',
                'CK': 'Cook Islands',
                'CR': 'Costa Rica',
                'CI': 'Cote d\'Ivoire',
                'HR': 'Croatia',
                'CU': 'Cuba',
                'CY': 'Cyprus',
                'CZ': 'Czech Republic',
                'DK': 'Denmark',
                'DJ': 'Djibouti',
                'DM': 'Dominica',
                'DO': 'Dominican Republic',
                'EC': 'Ecuador',
                'EG': 'Egypt',
                'SV': 'El Salvador',
                'GQ': 'Equatorial Guinea',
                'ER': 'Eritrea',
                'EE': 'Estonia',
                'ET': 'Ethiopia',
                'FO': 'Faroe Islands',
                'FK': 'Falkland Islands (Malvinas)',
                'FJ': 'Fiji the Fiji Islands',
                'FI': 'Finland',
                'FR': 'France, French Republic',
                'GF': 'French Guiana',
                'PF': 'French Polynesia',
                'TF': 'French Southern Territories',
                'GA': 'Gabon',
                'GM': 'Gambia the',
                'GE': 'Georgia',
                'DE': 'Germany',
                'GH': 'Ghana',
                'GI': 'Gibraltar',
                'GR': 'Greece',
                'GL': 'Greenland',
                'GD': 'Grenada',
                'GP': 'Guadeloupe',
                'GU': 'Guam',
                'GT': 'Guatemala',
                'GG': 'Guernsey',
                'GN': 'Guinea',
                'GW': 'Guinea-Bissau',
                'GY': 'Guyana',
                'HT': 'Haiti',
                'HM': 'Heard Island and McDonald Islands',
                'VA': 'Holy See (Vatican City State)',
                'HN': 'Honduras',
                'HK': 'Hong Kong',
                'HU': 'Hungary',
                'IS': 'Iceland',
                'IN': 'India',
                'ID': 'Indonesia',
                'IR': 'Iran',
                'IQ': 'Iraq',
                'IE': 'Ireland',
                'IM': 'Isle of Man',
                'IL': 'Israel',
                'IT': 'Italy',
                'JM': 'Jamaica',
                'JP': 'Japan',
                'JE': 'Jersey',
                'JO': 'Jordan',
                'KZ': 'Kazakhstan',
                'KE': 'Kenya',
                'KI': 'Kiribati',
                'KP': 'Korea',
                'KR': 'Korea',
                'KW': 'Kuwait',
                'KG': 'Kyrgyz Republic',
                'LV': 'Latvia',
                'LB': 'Lebanon',
                'LS': 'Lesotho',
                'LR': 'Liberia',
                'LI': 'Liechtenstein',
                'LT': 'Lithuania',
                'LU': 'Luxembourg',
                'MO': 'Macao',
                'MK': 'Macedonia',
                'MG': 'Madagascar',
                'MW': 'Malawi',
                'MY': 'Malaysia',
                'MV': 'Maldives',
                'ML': 'Mali',
                'MT': 'Malta',
                'MH': 'Marshall Islands',
                'MQ': 'Martinique',
                'MR': 'Mauritania',
                'MU': 'Mauritius',
                'YT': 'Mayotte',
                'MX': 'Mexico',
                'FM': 'Micronesia',
                'MD': 'Moldova',
                'MC': 'Monaco',
                'ME': 'Montenegro',
                'MS': 'Montserrat',
                'MA': 'Morocco',
                'MZ': 'Mozambique',
                'MM': 'Myanmar',
                'NA': 'Namibia',
                'NR': 'Nauru',
                'NP': 'Nepal',
                'AN': 'Netherlands Antilles',
                'NL': 'Netherlands the',
                'NC': 'New Caledonia',
                'NZ': 'New Zealand',
                'NI': 'Nicaragua',
                'NE': 'Niger',
                'NG': 'Nigeria',
                'NU': 'Niue',
                'NF': 'Norfolk Island',
                'MP': 'Northern Mariana Islands',
                'NO': 'Norway',
                'OM': 'Oman',
                'PK': 'Pakistan',
                'PW': 'Palau',
                'PS': 'Palestinian Territory',
                'PA': 'Panama',
                'PG': 'Papua New Guinea',
                'PY': 'Paraguay',
                'PE': 'Peru',
                'PH': 'Philippines',
                'PN': 'Pitcairn Islands',
                'PL': 'Poland',
                'PT': 'Portugal, Portuguese Republic',
                'PR': 'Puerto Rico',
                'QA': 'Qatar',
                'RE': 'Reunion',
                'RO': 'Romania',
                'RW': 'Rwanda',
                'BL': 'Saint Barthelemy',
                'SH': 'Saint Helena',
                'KN': 'Saint Kitts and Nevis',
                'LC': 'Saint Lucia',
                'MF': 'Saint Martin',
                'PM': 'Saint Pierre and Miquelon',
                'VC': 'Saint Vincent and the Grenadines',
                'SM': 'San Marino',
                'ST': 'Sao Tome and Principe',
                'SA': 'Saudi Arabia',
                'SN': 'Senegal',
                'RS': 'Serbia',
                'SC': 'Seychelles',
                'SL': 'Sierra Leone',
                'SG': 'Singapore',
                'SK': 'Slovakia (Slovak Republic)',
                'SI': 'Slovenia',
                'SB': 'Solomon Islands',
                'SO': 'Somalia, Somali Republic',
                'ZA': 'South Africa',
                'GS': 'South Georgia and the South Sandwich Islands',
                'ES': 'Spain',
                'LK': 'Sri Lanka',
                'SD': 'Sudan',
                'SR': 'Suriname',
                'SJ': 'Svalbard & Jan Mayen Islands',
                'SZ': 'Swaziland',
                'SE': 'Sweden',
                'CH': 'Switzerland, Swiss Confederation',
                'SY': 'Syrian Arab Republic',
                'TW': 'Taiwan',
                'TJ': 'Tajikistan',
                'TZ': 'Tanzania',
                'TH': 'Thailand',
                'TG': 'Togo',
                'TK': 'Tokelau',
                'TO': 'Tonga',
                'TT': 'Trinidad and Tobago',
                'TN': 'Tunisia',
                'TR': 'Turkey',
                'TC': 'Turks and Caicos Islands',
                'TV': 'Tuvalu',
                'UG': 'Uganda',
                'UA': 'Ukraine',
                'AE': 'United Arab Emirates',
                'GB': 'United Kingdom',
                'US': 'United States of America',
                'UM': 'United States Minor Outlying Islands',
                'VI': 'United States Virgin Islands',
                'UY': 'Uruguay, Eastern Republic of',
                'UZ': 'Uzbekistan',
                'VU': 'Vanuatu',
                'VE': 'Venezuela',
                'VN': 'Vietnam',
                'WF': 'Wallis and Futuna',
                'EH': 'Western Sahara',
                'ZM': 'Zambia',
                'ZW': 'Zimbabwe'
            },
            cart: this.$page.props.cart,
            form: useForm({
                email: '',
                country: null,
                firstName: '',
                lastName: '',
                address: '',
                address2: '',
                zipCode: '',
                city: '',
            })
        }
    },

    methods: {

        submit() {

            this.form.processing = true; 
            
            axios
                .post('/shipping')
                .then(response => (
                    console.log(response),
                    this.form.processing = false 
                ))
                .catch(() => (
                    console.log(error),
                    this.form.processing = false 
                ))
        }
    }
}
</script>