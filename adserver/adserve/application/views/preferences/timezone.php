<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<form onsubmit="return max_formValidate(this);" action="/reviveadserver/www/admin/account-user-name-language.php" method="post" enctype="multipart/form-data" name="settingsform" id="settingsform">
						<h3 class="middle-heading">Timezone Preferences</h3>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tbody>
								<tr>
									<td  colspan="4	">
										<input type="hidden" value="true" name="submitok">
										<img width="16" height="16" align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-settings.gif">&nbsp;
										<b>Timezone</b>
									</td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>
								<tr>
									<td width="5%"></td>
									<td valign="top" id="cell_username"  width="30%">Europe/Berlin                 </td>
									<td width="90%" valign="top" >
									<select tabindex="1" onchange="phpAds_refreshEnabled();" id="timezone" name="timezone">
										<option value="0"></option>
										<option value="Pacific/Kiritimati">(GMT+1400) Pacific/Kiritimati</option>
										<option value="Pacific/Enderbury">(GMT+1300) Pacific/Enderbury</option>
										<option value="Pacific/Tongatapu">(GMT+1300) Pacific/Tongatapu</option>
										<option value="Pacific/Chatham">(GMT+1245) Pacific/Chatham</option>
										<option value="Antarctica/McMurdo">(GMT+1200) Antarctica/McMurdo</option>
										<option value="Antarctica/South_Pole">(GMT+1200) Antarctica/South_Pole</option>
										<option value="Asia/Anadyr">(GMT+1200) Asia/Anadyr</option>
										<option value="Asia/Kamchatka">(GMT+1200) Asia/Kamchatka</option>
										<option value="Pacific/Auckland">(GMT+1200) Pacific/Auckland</option>
										<option value="Pacific/Fiji">(GMT+1200) Pacific/Fiji</option>
										<option value="Pacific/Funafuti">(GMT+1200) Pacific/Funafuti</option>
										<option value="Pacific/Kwajalein">(GMT+1200) Pacific/Kwajalein</option>
										<option value="Pacific/Majuro">(GMT+1200) Pacific/Majuro</option>
										<option value="Pacific/Nauru">(GMT+1200) Pacific/Nauru</option>
										<option value="Pacific/Tarawa">(GMT+1200) Pacific/Tarawa</option>
										<option value="Pacific/Wake">(GMT+1200) Pacific/Wake</option>
										<option value="Pacific/Wallis">(GMT+1200) Pacific/Wallis</option>
										<option value="Pacific/Norfolk">(GMT+1130) Pacific/Norfolk</option>
										<option value="Asia/Magadan">(GMT+1100) Asia/Magadan</option>
										<option value="Pacific/Efate">(GMT+1100) Pacific/Efate</option>
										<option value="Pacific/Guadalcanal">(GMT+1100) Pacific/Guadalcanal</option>
										<option value="Pacific/Kosrae">(GMT+1100) Pacific/Kosrae</option>
										<option value="Pacific/Noumea">(GMT+1100) Pacific/Noumea</option>
										<option value="Pacific/Ponape">(GMT+1100) Pacific/Ponape</option>
										<option value="Australia/LHI">(GMT+1030) Australia/LHI</option>
										<option value="Australia/Lord_Howe">(GMT+1030) Australia/Lord_Howe</option>
										<option value="Antarctica/DumontDUrville">(GMT+1000) Antarctica/DumontDUrville</option>
										<option value="Asia/Sakhalin">(GMT+1000) Asia/Sakhalin</option>
										<option value="Asia/Vladivostok">(GMT+1000) Asia/Vladivostok</option>
										<option value="Australia/ACT">(GMT+1000) Australia/ACT</option>
										<option value="Australia/Brisbane">(GMT+1000) Australia/Brisbane</option>
										<option value="Australia/Canberra">(GMT+1000) Australia/Canberra</option>
										<option value="Australia/Hobart">(GMT+1000) Australia/Hobart</option>
										<option value="Australia/Lindeman">(GMT+1000) Australia/Lindeman</option>
										<option value="Australia/Melbourne">(GMT+1000) Australia/Melbourne</option>
										<option value="Australia/NSW">(GMT+1000) Australia/NSW</option>
										<option value="Australia/Queensland">(GMT+1000) Australia/Queensland</option>
										<option value="Australia/Sydney">(GMT+1000) Australia/Sydney</option>
										<option value="Australia/Tasmania">(GMT+1000) Australia/Tasmania</option>
										<option value="Australia/Victoria">(GMT+1000) Australia/Victoria</option>
										<option value="Pacific/Guam">(GMT+1000) Pacific/Guam</option>
										<option value="Pacific/Port_Moresby">(GMT+1000) Pacific/Port_Moresby</option>
										<option value="Pacific/Saipan">(GMT+1000) Pacific/Saipan</option>
										<option value="Pacific/Truk">(GMT+1000) Pacific/Truk</option>
										<option value="Pacific/Yap">(GMT+1000) Pacific/Yap</option>
										<option value="Australia/Adelaide">(GMT+0930) Australia/Adelaide</option>
										<option value="Australia/Broken_Hill">(GMT+0930) Australia/Broken_Hill</option>
										<option value="Australia/Darwin">(GMT+0930) Australia/Darwin</option>
										<option value="Australia/North">(GMT+0930) Australia/North</option>
										<option value="Australia/South">(GMT+0930) Australia/South</option>
										<option value="Australia/Yancowinna">(GMT+0930) Australia/Yancowinna</option>
										<option value="Asia/Choibalsan">(GMT+0900) Asia/Choibalsan</option>
										<option value="Asia/Dili">(GMT+0900) Asia/Dili</option>
										<option value="Asia/Jayapura">(GMT+0900) Asia/Jayapura</option>
										<option value="Asia/Pyongyang">(GMT+0900) Asia/Pyongyang</option>
										<option value="Asia/Seoul">(GMT+0900) Asia/Seoul</option>
										<option value="Asia/Tokyo">(GMT+0900) Asia/Tokyo</option>
										<option value="Asia/Yakutsk">(GMT+0900) Asia/Yakutsk</option>
										<option value="Pacific/Palau">(GMT+0900) Pacific/Palau</option>
										<option value="Antarctica/Casey">(GMT+0800) Antarctica/Casey</option>
										<option value="Asia/Brunei">(GMT+0800) Asia/Brunei</option>
										<option value="Asia/Chongqing">(GMT+0800) Asia/Chongqing</option>
										<option value="Asia/Chungking">(GMT+0800) Asia/Chungking</option>
										<option value="Asia/Harbin">(GMT+0800) Asia/Harbin</option>
										<option value="Asia/Hong_Kong">(GMT+0800) Asia/Hong_Kong</option>
										<option value="Asia/Irkutsk">(GMT+0800) Asia/Irkutsk</option>
										<option value="Asia/Kashgar">(GMT+0800) Asia/Kashgar</option>
										<option value="Asia/Kuala_Lumpur">(GMT+0800) Asia/Kuala_Lumpur</option>
										<option value="Asia/Kuching">(GMT+0800) Asia/Kuching</option>
										<option value="Asia/Macao">(GMT+0800) Asia/Macao</option>
										<option value="Asia/Manila">(GMT+0800) Asia/Manila</option>
										<option value="Asia/Shanghai">(GMT+0800) Asia/Shanghai</option>
										<option value="Asia/Singapore">(GMT+0800) Asia/Singapore</option>
										<option value="Asia/Taipei">(GMT+0800) Asia/Taipei</option>
										<option value="Asia/Ujung_Pandang">(GMT+0800) Asia/Ujung_Pandang</option>
										<option value="Asia/Ulaanbaatar">(GMT+0800) Asia/Ulaanbaatar</option>
										<option value="Asia/Ulan_Bator">(GMT+0800) Asia/Ulan_Bator</option>
										<option value="Asia/Urumqi">(GMT+0800) Asia/Urumqi</option>
										<option value="Australia/Perth">(GMT+0800) Australia/Perth</option>
										<option value="Australia/West">(GMT+0800) Australia/West</option>
										<option value="Antarctica/Davis">(GMT+0700) Antarctica/Davis</option>
										<option value="Asia/Bangkok">(GMT+0700) Asia/Bangkok</option>
										<option value="Asia/Hovd">(GMT+0700) Asia/Hovd</option>
										<option value="Asia/Jakarta">(GMT+0700) Asia/Jakarta</option>
										<option value="Asia/Krasnoyarsk">(GMT+0700) Asia/Krasnoyarsk</option>
										<option value="Asia/Phnom_Penh">(GMT+0700) Asia/Phnom_Penh</option>
										<option value="Asia/Pontianak">(GMT+0700) Asia/Pontianak</option>
										<option value="Asia/Saigon">(GMT+0700) Asia/Saigon</option>
										<option value="Asia/Vientiane">(GMT+0700) Asia/Vientiane</option>
										<option value="Indian/Christmas">(GMT+0700) Indian/Christmas</option>
										<option value="Asia/Rangoon">(GMT+0630) Asia/Rangoon</option>
										<option value="Indian/Cocos">(GMT+0630) Indian/Cocos</option>
										<option value="Antarctica/Mawson">(GMT+0600) Antarctica/Mawson</option>
										<option value="Antarctica/Vostok">(GMT+0600) Antarctica/Vostok</option>
										<option value="Asia/Almaty">(GMT+0600) Asia/Almaty</option>
										<option value="Asia/Colombo">(GMT+0600) Asia/Colombo</option>
										<option value="Asia/Dacca">(GMT+0600) Asia/Dacca</option>
										<option value="Asia/Dhaka">(GMT+0600) Asia/Dhaka</option>
										<option value="Asia/Novosibirsk">(GMT+0600) Asia/Novosibirsk</option>
										<option value="Asia/Omsk">(GMT+0600) Asia/Omsk</option>
										<option value="Asia/Thimbu">(GMT+0600) Asia/Thimbu</option>
										<option value="Asia/Thimphu">(GMT+0600) Asia/Thimphu</option>
										<option value="Indian/Chagos">(GMT+0600) Indian/Chagos</option>
										<option value="Asia/Katmandu">(GMT+0545) Asia/Katmandu</option>
										<option value="Asia/Calcutta">(GMT+0530) Asia/Calcutta</option>
										<option value="Asia/Aqtobe">(GMT+0500) Asia/Aqtobe</option>
										<option value="Asia/Ashgabat">(GMT+0500) Asia/Ashgabat</option>
										<option value="Asia/Ashkhabad">(GMT+0500) Asia/Ashkhabad</option>
										<option value="Asia/Bishkek">(GMT+0500) Asia/Bishkek</option>
										<option value="Asia/Dushanbe">(GMT+0500) Asia/Dushanbe</option>
										<option value="Asia/Karachi">(GMT+0500) Asia/Karachi</option>
										<option value="Asia/Samarkand">(GMT+0500) Asia/Samarkand</option>
										<option value="Asia/Tashkent">(GMT+0500) Asia/Tashkent</option>
										<option value="Asia/Yekaterinburg">(GMT+0500) Asia/Yekaterinburg</option>
										<option value="Indian/Kerguelen">(GMT+0500) Indian/Kerguelen</option>
										<option value="Indian/Maldives">(GMT+0500) Indian/Maldives</option>
										<option value="Asia/Kabul">(GMT+0430) Asia/Kabul</option>
										<option value="Asia/Aqtau">(GMT+0400) Asia/Aqtau</option>
										<option value="Asia/Baku">(GMT+0400) Asia/Baku</option>
										<option value="Asia/Dubai">(GMT+0400) Asia/Dubai</option>
										<option value="Asia/Muscat">(GMT+0400) Asia/Muscat</option>
										<option value="Asia/Tbilisi">(GMT+0400) Asia/Tbilisi</option>
										<option value="Asia/Yerevan">(GMT+0400) Asia/Yerevan</option>
										<option value="Europe/Samara">(GMT+0400) Europe/Samara</option>
										<option value="Indian/Mahe">(GMT+0400) Indian/Mahe</option>
										<option value="Indian/Mauritius">(GMT+0400) Indian/Mauritius</option>
										<option value="Indian/Reunion">(GMT+0400) Indian/Reunion</option>
										<option value="Asia/Tehran">(GMT+0330) Asia/Tehran</option>
										<option value="Africa/Addis_Ababa">(GMT+0300) Africa/Addis_Ababa</option>
										<option value="Africa/Asmera">(GMT+0300) Africa/Asmera</option>
										<option value="Africa/Dar_es_Salaam">(GMT+0300) Africa/Dar_es_Salaam</option>
										<option value="Africa/Djibouti">(GMT+0300) Africa/Djibouti</option>
										<option value="Africa/Kampala">(GMT+0300) Africa/Kampala</option>
										<option value="Africa/Khartoum">(GMT+0300) Africa/Khartoum</option>
										<option value="Africa/Mogadishu">(GMT+0300) Africa/Mogadishu</option>
										<option value="Africa/Nairobi">(GMT+0300) Africa/Nairobi</option>
										<option value="Antarctica/Syowa">(GMT+0300) Antarctica/Syowa</option>
										<option value="Asia/Aden">(GMT+0300) Asia/Aden</option>
										<option value="Asia/Baghdad">(GMT+0300) Asia/Baghdad</option>
										<option value="Asia/Bahrain">(GMT+0300) Asia/Bahrain</option>
										<option value="Asia/Kuwait">(GMT+0300) Asia/Kuwait</option>
										<option value="Asia/Qatar">(GMT+0300) Asia/Qatar</option>
										<option value="Asia/Riyadh">(GMT+0300) Asia/Riyadh</option>
										<option value="Europe/Moscow">(GMT+0300) Europe/Moscow</option>
										<option value="Indian/Antananarivo">(GMT+0300) Indian/Antananarivo</option>
										<option value="Indian/Comoro">(GMT+0300) Indian/Comoro</option>
										<option value="Indian/Mayotte">(GMT+0300) Indian/Mayotte</option>
										<option value="Africa/Blantyre">(GMT+0200) Africa/Blantyre</option>
										<option value="Africa/Bujumbura">(GMT+0200) Africa/Bujumbura</option>
										<option value="Africa/Cairo">(GMT+0200) Africa/Cairo</option>
										<option value="Africa/Gaborone">(GMT+0200) Africa/Gaborone</option>
										<option value="Africa/Harare">(GMT+0200) Africa/Harare</option>
										<option value="Africa/Johannesburg">(GMT+0200) Africa/Johannesburg</option>
										<option value="Africa/Kigali">(GMT+0200) Africa/Kigali</option>
										<option value="Africa/Lubumbashi">(GMT+0200) Africa/Lubumbashi</option>
										<option value="Africa/Lusaka">(GMT+0200) Africa/Lusaka</option>
										<option value="Africa/Maputo">(GMT+0200) Africa/Maputo</option>
										<option value="Africa/Maseru">(GMT+0200) Africa/Maseru</option>
										<option value="Africa/Mbabane">(GMT+0200) Africa/Mbabane</option>
										<option value="Africa/Tripoli">(GMT+0200) Africa/Tripoli</option>
										<option value="Asia/Amman">(GMT+0200) Asia/Amman</option>
										<option value="Asia/Beirut">(GMT+0200) Asia/Beirut</option>
										<option value="Asia/Damascus">(GMT+0200) Asia/Damascus</option>
										<option value="Asia/Gaza">(GMT+0200) Asia/Gaza</option>
										<option value="Asia/Istanbul">(GMT+0200) Asia/Istanbul</option>
										<option value="Asia/Jerusalem">(GMT+0200) Asia/Jerusalem</option>
										<option value="Asia/Nicosia">(GMT+0200) Asia/Nicosia</option>
										<option value="Asia/Tel_Aviv">(GMT+0200) Asia/Tel_Aviv</option>
										<option value="Europe/Athens">(GMT+0200) Europe/Athens</option>
										<option value="Europe/Bucharest">(GMT+0200) Europe/Bucharest</option>
										<option value="Europe/Chisinau">(GMT+0200) Europe/Chisinau</option>
										<option value="Europe/Helsinki">(GMT+0200) Europe/Helsinki</option>
										<option value="Europe/Istanbul">(GMT+0200) Europe/Istanbul</option>
										<option value="Europe/Kaliningrad">(GMT+0200) Europe/Kaliningrad</option>
										<option value="Europe/Kiev">(GMT+0200) Europe/Kiev</option>
										<option value="Europe/Minsk">(GMT+0200) Europe/Minsk</option>
										<option value="Europe/Nicosia">(GMT+0200) Europe/Nicosia</option>
										<option value="Europe/Riga">(GMT+0200) Europe/Riga</option>
										<option value="Europe/Simferopol">(GMT+0200) Europe/Simferopol</option>
										<option value="Europe/Sofia">(GMT+0200) Europe/Sofia</option>
										<option value="Europe/Tallinn">(GMT+0200) Europe/Tallinn</option>
										<option value="Europe/Tiraspol">(GMT+0200) Europe/Tiraspol</option>
										<option value="Europe/Uzhgorod">(GMT+0200) Europe/Uzhgorod</option>
										<option value="Europe/Vilnius">(GMT+0200) Europe/Vilnius</option>
										<option value="Europe/Zaporozhye">(GMT+0200) Europe/Zaporozhye</option>
										<option value="Africa/Algiers">(GMT+0100) Africa/Algiers</option>
										<option value="Africa/Bangui">(GMT+0100) Africa/Bangui</option>
										<option value="Africa/Brazzaville">(GMT+0100) Africa/Brazzaville</option>
										<option value="Africa/Ceuta">(GMT+0100) Africa/Ceuta</option>
										<option value="Africa/Douala">(GMT+0100) Africa/Douala</option>
										<option value="Africa/Kinshasa">(GMT+0100) Africa/Kinshasa</option>
										<option value="Africa/Lagos">(GMT+0100) Africa/Lagos</option>
										<option value="Africa/Libreville">(GMT+0100) Africa/Libreville</option>
										<option value="Africa/Luanda">(GMT+0100) Africa/Luanda</option>
										<option value="Africa/Malabo">(GMT+0100) Africa/Malabo</option>
										<option value="Africa/Ndjamena">(GMT+0100) Africa/Ndjamena</option>
										<option value="Africa/Niamey">(GMT+0100) Africa/Niamey</option>
										<option value="Africa/Porto-Novo">(GMT+0100) Africa/Porto-Novo</option>
										<option value="Africa/Tunis">(GMT+0100) Africa/Tunis</option>
										<option value="Africa/Windhoek">(GMT+0100) Africa/Windhoek</option>
										<option value="Arctic/Longyearbyen">(GMT+0100) Arctic/Longyearbyen</option>
										<option value="Atlantic/Jan_Mayen">(GMT+0100) Atlantic/Jan_Mayen</option>
										<option value="Europe/Amsterdam">(GMT+0100) Europe/Amsterdam</option>
										<option value="Europe/Andorra">(GMT+0100) Europe/Andorra</option>
										<option value="Europe/Belgrade">(GMT+0100) Europe/Belgrade</option>
										<option selected="selected" value="Europe/Berlin">(GMT+0100) Europe/Berlin</option>
										<option value="Europe/Bratislava">(GMT+0100) Europe/Bratislava</option>
										<option value="Europe/Brussels">(GMT+0100) Europe/Brussels</option>
										<option value="Europe/Budapest">(GMT+0100) Europe/Budapest</option>
										<option value="Europe/Copenhagen">(GMT+0100) Europe/Copenhagen</option>
										<option value="Europe/Gibraltar">(GMT+0100) Europe/Gibraltar</option>
										<option value="Europe/Ljubljana">(GMT+0100) Europe/Ljubljana</option>
										<option value="Europe/Luxembourg">(GMT+0100) Europe/Luxembourg</option>
										<option value="Europe/Madrid">(GMT+0100) Europe/Madrid</option>
										<option value="Europe/Malta">(GMT+0100) Europe/Malta</option>
										<option value="Europe/Monaco">(GMT+0100) Europe/Monaco</option>
										<option value="Europe/Oslo">(GMT+0100) Europe/Oslo</option>
										<option value="Europe/Paris">(GMT+0100) Europe/Paris</option>
										<option value="Europe/Prague">(GMT+0100) Europe/Prague</option>
										<option value="Europe/Rome">(GMT+0100) Europe/Rome</option>
										<option value="Europe/San_Marino">(GMT+0100) Europe/San_Marino</option>
										<option value="Europe/Sarajevo">(GMT+0100) Europe/Sarajevo</option>
										<option value="Europe/Skopje">(GMT+0100) Europe/Skopje</option>
										<option value="Europe/Stockholm">(GMT+0100) Europe/Stockholm</option>
										<option value="Europe/Tirane">(GMT+0100) Europe/Tirane</option>
										<option value="Europe/Vaduz">(GMT+0100) Europe/Vaduz</option>
										<option value="Europe/Vatican">(GMT+0100) Europe/Vatican</option>
										<option value="Europe/Vienna">(GMT+0100) Europe/Vienna</option>
										<option value="Europe/Warsaw">(GMT+0100) Europe/Warsaw</option>
										<option value="Europe/Zagreb">(GMT+0100) Europe/Zagreb</option>
										<option value="Europe/Zurich">(GMT+0100) Europe/Zurich</option>
										<option value="Africa/Abidjan">(GMT+0000) Africa/Abidjan</option>
										<option value="Africa/Accra">(GMT+0000) Africa/Accra</option>
										<option value="Africa/Bamako">(GMT+0000) Africa/Bamako</option>
										<option value="Africa/Banjul">(GMT+0000) Africa/Banjul</option>
										<option value="Africa/Bissau">(GMT+0000) Africa/Bissau</option>
										<option value="Africa/Casablanca">(GMT+0000) Africa/Casablanca</option>
										<option value="Africa/Conakry">(GMT+0000) Africa/Conakry</option>
										<option value="Africa/Dakar">(GMT+0000) Africa/Dakar</option>
										<option value="Africa/El_Aaiun">(GMT+0000) Africa/El_Aaiun</option>
										<option value="Africa/Freetown">(GMT+0000) Africa/Freetown</option>
										<option value="Africa/Lome">(GMT+0000) Africa/Lome</option>
										<option value="Africa/Monrovia">(GMT+0000) Africa/Monrovia</option>
										<option value="Africa/Nouakchott">(GMT+0000) Africa/Nouakchott</option>
										<option value="Africa/Ouagadougou">(GMT+0000) Africa/Ouagadougou</option>
										<option value="Africa/Sao_Tome">(GMT+0000) Africa/Sao_Tome</option>
										<option value="Africa/Timbuktu">(GMT+0000) Africa/Timbuktu</option>
										<option value="America/Danmarkshavn">(GMT+0000) America/Danmarkshavn</option>
										<option value="Atlantic/Canary">(GMT+0000) Atlantic/Canary</option>
										<option value="Atlantic/Faeroe">(GMT+0000) Atlantic/Faeroe</option>
										<option value="Atlantic/Madeira">(GMT+0000) Atlantic/Madeira</option>
										<option value="Atlantic/Reykjavik">(GMT+0000) Atlantic/Reykjavik</option>
										<option value="Atlantic/St_Helena">(GMT+0000) Atlantic/St_Helena</option>
										<option value="Europe/Belfast">(GMT+0000) Europe/Belfast</option>
										<option value="Europe/Dublin">(GMT+0000) Europe/Dublin</option>
										<option value="Europe/Lisbon">(GMT+0000) Europe/Lisbon</option>
										<option value="Europe/London">(GMT+0000) Europe/London</option>
										<option value="GB">(GMT+0000) GB</option>
										<option value="America/Scoresbysund">(GMT-0100) America/Scoresbysund</option>
										<option value="Atlantic/Azores">(GMT-0100) Atlantic/Azores</option>
										<option value="Atlantic/Cape_Verde">(GMT-0100) Atlantic/Cape_Verde</option>
										<option value="America/Noronha">(GMT-0200) America/Noronha</option>
										<option value="Atlantic/South_Georgia">(GMT-0200) Atlantic/South_Georgia</option>
										<option value="America/Araguaina">(GMT-0300) America/Araguaina</option>
										<option value="America/Belem">(GMT-0300) America/Belem</option>
										<option value="America/Buenos_Aires">(GMT-0300) America/Buenos_Aires</option>
										<option value="America/Catamarca">(GMT-0300) America/Catamarca</option>
										<option value="America/Cayenne">(GMT-0300) America/Cayenne</option>
										<option value="America/Cordoba">(GMT-0300) America/Cordoba</option>
										<option value="America/Fortaleza">(GMT-0300) America/Fortaleza</option>
										<option value="America/Godthab">(GMT-0300) America/Godthab</option>
										<option value="America/Jujuy">(GMT-0300) America/Jujuy</option>
										<option value="America/Maceio">(GMT-0300) America/Maceio</option>
										<option value="America/Mendoza">(GMT-0300) America/Mendoza</option>
										<option value="America/Miquelon">(GMT-0300) America/Miquelon</option>
										<option value="America/Montevideo">(GMT-0300) America/Montevideo</option>
										<option value="America/Paramaribo">(GMT-0300) America/Paramaribo</option>
										<option value="America/Recife">(GMT-0300) America/Recife</option>
										<option value="America/Rosario">(GMT-0300) America/Rosario</option>
										<option value="America/Sao_Paulo">(GMT-0300) America/Sao_Paulo</option>
										<option value="America/St_Johns">(GMT-0330) America/St_Johns</option>
										<option value="America/Anguilla">(GMT-0400) America/Anguilla</option>
										<option value="America/Antigua">(GMT-0400) America/Antigua</option>
										<option value="America/Aruba">(GMT-0400) America/Aruba</option>
										<option value="America/Asuncion">(GMT-0400) America/Asuncion</option>
										<option value="America/Barbados">(GMT-0400) America/Barbados</option>
										<option value="America/Boa_Vista">(GMT-0400) America/Boa_Vista</option>
										<option value="America/Caracas">(GMT-0400) America/Caracas</option>
										<option value="America/Cuiaba">(GMT-0400) America/Cuiaba</option>
										<option value="America/Curacao">(GMT-0400) America/Curacao</option>
										<option value="America/Dominica">(GMT-0400) America/Dominica</option>
										<option value="America/Glace_Bay">(GMT-0400) America/Glace_Bay</option>
										<option value="America/Goose_Bay">(GMT-0400) America/Goose_Bay</option>
										<option value="America/Grenada">(GMT-0400) America/Grenada</option>
										<option value="America/Guadeloupe">(GMT-0400) America/Guadeloupe</option>
										<option value="America/Guyana">(GMT-0400) America/Guyana</option>
										<option value="America/Halifax">(GMT-0400) America/Halifax</option>
										<option value="America/La_Paz">(GMT-0400) America/La_Paz</option>
										<option value="America/Manaus">(GMT-0400) America/Manaus</option>
										<option value="America/Martinique">(GMT-0400) America/Martinique</option>
										<option value="America/Montserrat">(GMT-0400) America/Montserrat</option>
										<option value="America/Port_of_Spain">(GMT-0400) America/Port_of_Spain</option>
										<option value="America/Porto_Velho">(GMT-0400) America/Porto_Velho</option>
										<option value="America/Puerto_Rico">(GMT-0400) America/Puerto_Rico</option>
										<option value="America/Santiago">(GMT-0400) America/Santiago</option>
										<option value="America/Santo_Domingo">(GMT-0400) America/Santo_Domingo</option>
										<option value="America/St_Kitts">(GMT-0400) America/St_Kitts</option>
										<option value="America/St_Lucia">(GMT-0400) America/St_Lucia</option>
										<option value="America/St_Thomas">(GMT-0400) America/St_Thomas</option>
										<option value="America/St_Vincent">(GMT-0400) America/St_Vincent</option>
										<option value="America/Thule">(GMT-0400) America/Thule</option>
										<option value="America/Tortola">(GMT-0400) America/Tortola</option>
										<option value="America/Virgin">(GMT-0400) America/Virgin</option>
										<option value="Antarctica/Palmer">(GMT-0400) Antarctica/Palmer</option>
										<option value="Atlantic/Bermuda">(GMT-0400) Atlantic/Bermuda</option>
										<option value="Atlantic/Stanley">(GMT-0400) Atlantic/Stanley</option>
										<option value="America/Bogota">(GMT-0500) America/Bogota</option>
										<option value="America/Cayman">(GMT-0500) America/Cayman</option>
										<option value="America/Detroit">(GMT-0500) America/Detroit</option>
										<option value="America/Eirunepe">(GMT-0500) America/Eirunepe</option>
										<option value="America/Fort_Wayne">(GMT-0500) America/Fort_Wayne</option>
										<option value="America/Grand_Turk">(GMT-0500) America/Grand_Turk</option>
										<option value="America/Guayaquil">(GMT-0500) America/Guayaquil</option>
										<option value="America/Havana">(GMT-0500) America/Havana</option>
										<option value="America/Indiana/Indianapolis">(GMT-0500) America/Indiana/Indianapolis</option>
										<option value="America/Indiana/Knox">(GMT-0500) America/Indiana/Knox</option>
										<option value="America/Indiana/Marengo">(GMT-0500) America/Indiana/Marengo</option>
										<option value="America/Indiana/Vevay">(GMT-0500) America/Indiana/Vevay</option>
										<option value="America/Indianapolis">(GMT-0500) America/Indianapolis</option>
										<option value="America/Iqaluit">(GMT-0500) America/Iqaluit</option>
										<option value="America/Jamaica">(GMT-0500) America/Jamaica</option>
										<option value="America/Kentucky/Louisville">(GMT-0500) America/Kentucky/Louisville</option>
										<option value="America/Kentucky/Monticello">(GMT-0500) America/Kentucky/Monticello</option>
										<option value="America/Knox_IN">(GMT-0500) America/Knox_IN</option>
										<option value="America/Lima">(GMT-0500) America/Lima</option>
										<option value="America/Louisville">(GMT-0500) America/Louisville</option>
										<option value="America/Montreal">(GMT-0500) America/Montreal</option>
										<option value="America/Nassau">(GMT-0500) America/Nassau</option>
										<option value="America/New_York">(GMT-0500) America/New_York</option>
										<option value="America/Nipigon">(GMT-0500) America/Nipigon</option>
										<option value="America/Panama">(GMT-0500) America/Panama</option>
										<option value="America/Pangnirtung">(GMT-0500) America/Pangnirtung</option>
										<option value="America/Port-au-Prince">(GMT-0500) America/Port-au-Prince</option>
										<option value="America/Porto_Acre">(GMT-0500) America/Porto_Acre</option>
										<option value="America/Rio_Branco">(GMT-0500) America/Rio_Branco</option>
										<option value="America/Thunder_Bay">(GMT-0500) America/Thunder_Bay</option>
										<option value="America/Belize">(GMT-0600) America/Belize</option>
										<option value="America/Cancun">(GMT-0600) America/Cancun</option>
										<option value="America/Chicago">(GMT-0600) America/Chicago</option>
										<option value="America/Costa_Rica">(GMT-0600) America/Costa_Rica</option>
										<option value="America/El_Salvador">(GMT-0600) America/El_Salvador</option>
										<option value="America/Guatemala">(GMT-0600) America/Guatemala</option>
										<option value="America/Managua">(GMT-0600) America/Managua</option>
										<option value="America/Menominee">(GMT-0600) America/Menominee</option>
										<option value="America/Merida">(GMT-0600) America/Merida</option>
										<option value="America/Mexico_City">(GMT-0600) America/Mexico_City</option>
										<option value="America/Monterrey">(GMT-0600) America/Monterrey</option>
										<option value="America/North_Dakota/Center">(GMT-0600) America/North_Dakota/Center</option>
										<option value="America/Rainy_River">(GMT-0600) America/Rainy_River</option>
										<option value="America/Rankin_Inlet">(GMT-0600) America/Rankin_Inlet</option>
										<option value="America/Regina">(GMT-0600) America/Regina</option>
										<option value="America/Swift_Current">(GMT-0600) America/Swift_Current</option>
										<option value="America/Tegucigalpa">(GMT-0600) America/Tegucigalpa</option>
										<option value="America/Winnipeg">(GMT-0600) America/Winnipeg</option>
										<option value="Pacific/Easter">(GMT-0600) Pacific/Easter</option>
										<option value="Pacific/Galapagos">(GMT-0600) Pacific/Galapagos</option>
										<option value="America/Boise">(GMT-0700) America/Boise</option>
										<option value="America/Cambridge_Bay">(GMT-0700) America/Cambridge_Bay</option>
										<option value="America/Chihuahua">(GMT-0700) America/Chihuahua</option>
										<option value="America/Dawson_Creek">(GMT-0700) America/Dawson_Creek</option>
										<option value="America/Denver">(GMT-0700) America/Denver</option>
										<option value="America/Edmonton">(GMT-0700) America/Edmonton</option>
										<option value="America/Hermosillo">(GMT-0700) America/Hermosillo</option>
										<option value="America/Inuvik">(GMT-0700) America/Inuvik</option>
										<option value="America/Mazatlan">(GMT-0700) America/Mazatlan</option>
										<option value="America/Phoenix">(GMT-0700) America/Phoenix</option>
										<option value="America/Shiprock">(GMT-0700) America/Shiprock</option>
										<option value="America/Yellowknife">(GMT-0700) America/Yellowknife</option>
										<option value="America/Dawson">(GMT-0800) America/Dawson</option>
										<option value="America/Ensenada">(GMT-0800) America/Ensenada</option>
										<option value="America/Los_Angeles">(GMT-0800) America/Los_Angeles</option>
										<option value="America/Tijuana">(GMT-0800) America/Tijuana</option>
										<option value="America/Vancouver">(GMT-0800) America/Vancouver</option>
										<option value="America/Whitehorse">(GMT-0800) America/Whitehorse</option>
										<option value="Pacific/Pitcairn">(GMT-0800) Pacific/Pitcairn</option>
										<option value="America/Anchorage">(GMT-0900) America/Anchorage</option>
										<option value="America/Juneau">(GMT-0900) America/Juneau</option>
										<option value="America/Nome">(GMT-0900) America/Nome</option>
										<option value="America/Yakutat">(GMT-0900) America/Yakutat</option>
										<option value="Pacific/Gambier">(GMT-0900) Pacific/Gambier</option>
										<option value="Pacific/Marquesas">(GMT-0930) Pacific/Marquesas</option>
										<option value="America/Adak">(GMT-1000) America/Adak</option>
										<option value="America/Atka">(GMT-1000) America/Atka</option>
										<option value="Pacific/Fakaofo">(GMT-1000) Pacific/Fakaofo</option>
										<option value="Pacific/Honolulu">(GMT-1000) Pacific/Honolulu</option>
										<option value="Pacific/Johnston">(GMT-1000) Pacific/Johnston</option>
										<option value="Pacific/Rarotonga">(GMT-1000) Pacific/Rarotonga</option>
										<option value="Pacific/Tahiti">(GMT-1000) Pacific/Tahiti</option>
										<option value="Pacific/Apia">(GMT-1100) Pacific/Apia</option>
										<option value="Pacific/Midway">(GMT-1100) Pacific/Midway</option>
										<option value="Pacific/Niue">(GMT-1100) Pacific/Niue</option>
										<option value="Pacific/Pago_Pago">(GMT-1100) Pacific/Pago_Pago</option>
										<option value="Pacific/Samoa">(GMT-1100) Pacific/Samoa</option>

            </select>						<td></td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>

							</tbody>
						</table>
						
						
						<input type="hidden" value="15237771589c4ab7dab0d9e7e9cd7e83" id="token" name="token">    
						<input type="submit" class="btn btn-primary" tabindex="4" value="Save Changes" name="submitsettings"></form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
			<?php $this->load->view('admin_includes/footer');?>
			<script src="<?php echo base_url();?>assets/js/adserver.js"></script>



																												