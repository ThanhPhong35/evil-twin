#!/usr/bin/env bash
tmpdir="/tmp/"

function explore_for_targets_option() {

	debug_print

	local cypher_filter
	if [ -n "${1}" ]; then
		cypher_filter="${1}"
		case ${cypher_filter} in
			"WEP")
				#Only WEP
			;;
			"WPA1")
				#Only WPA including WPA/WPA2 in Mixed mode
				#Not used yet in airgeddon
				:
			;;
			"WPA2")
				#Only WPA2 including WPA/WPA2 and WPA2/WPA3 in Mixed mode
				#Not used yet in airgeddon
				:
			;;
			"WPA3")
				#Only WPA3 including WPA2/WPA3 in Mixed mode
				#Not used yet in airgeddon
				:
			;;
			"WPA")
				#All, WPA, WPA2 and WPA3 including all Mixed modes

			;;
		esac
		cypher_cmd=" --encrypt ${cypher_filter} "
	else
		cypher_filter=""
		cypher_cmd=" "		
	fi
	tmpfiles_toclean=1
	rm -rf "${tmpdir}nws"* > /dev/null 2>&1
	rm -rf "${tmpdir}clts.csv" > /dev/null 2>&1
	echo "Begin" >> "${tmpdir}explorewifi.txt"
	
	airodump_band_modifier="abg"

	recalculate_windows_sizes
	manage_output "+j -bg \"#000000\" -fg \"#FFFFFF\" -geometry ${g1_topright_window} -T \"Exploring for targets\"" "airodump-ng -w ${tmpdir}nws${cypher_cmd}${interface} --band ${airodump_band_modifier}" "Exploring for targets" "active"
	wait_for_process "airodump-ng -w ${tmpdir}nws${cypher_cmd}${interface} --band ${airodump_band_modifier}" "Exploring for targets"
	targetline=$(awk '/(^Station[s]?|^Client[es]?)/{print NR}' "${tmpdir}nws-01.csv" 2> /dev/null)
	targetline=$((targetline - 1))
	head -n "${targetline}" "${tmpdir}nws-01.csv" &> "${tmpdir}nws.csv"
	tail -n +"${targetline}" "${tmpdir}nws-01.csv" &> "${tmpdir}clts.csv"

	csvline=$(wc -l "${tmpdir}nws.csv" 2> /dev/null | awk '{print $1}')
	if [ "${csvline}" -le 3 ]; then
		echo
		language_strings "${language}" 68 "red"
		language_strings "${language}" 115 "read"
		return 1
	fi

	rm -rf "${tmpdir}nws.txt" > /dev/null 2>&1
	rm -rf "${tmpdir}wnws.txt" > /dev/null 2>&1
	local i=0
	local enterprise_network_counter
	local pure_wpa3
	while IFS=, read -r exp_mac _ _ exp_channel _ exp_enc _ exp_auth exp_power _ _ _ exp_idlength exp_essid _; do

		pure_wpa3=""
		chars_mac=${#exp_mac}
		if [ "${chars_mac}" -ge 17 ]; then
			i=$((i + 1))
			if [ "${exp_power}" -lt 0 ]; then
				if [ "${exp_power}" -eq -1 ]; then
					exp_power=0
				else
					exp_power=$((exp_power + 100))
				fi
			fi

			exp_power=$(echo "${exp_power}" | awk '{gsub(/ /,""); print}')
			exp_essid=${exp_essid:1:${exp_idlength}}

			if [[ ${exp_channel} =~ ${valid_channels_24_and_5_ghz_regexp} ]]; then
				exp_channel=$(echo "${exp_channel}" | awk '{gsub(/ /,""); print}')
			else
				exp_channel=0
			fi

			if [[ "${exp_essid}" = "" ]] || [[ "${exp_channel}" = "-1" ]]; then
				exp_essid="(Hidden Network)"
			fi

			exp_enc=$(echo "${exp_enc}" | awk '{print $1}')

			if [ -n "${1}" ]; then
				case ${cypher_filter} in
					"WEP")
						#Only WEP
						echo -e "${exp_mac},${exp_channel},${exp_power},${exp_essid},${exp_enc}" >> "${tmpdir}nws.txt"
					;;
					"WPA1")
						#Only WPA including WPA/WPA2 in Mixed mode
						#Not used yet in airgeddon
						echo -e "${exp_mac},${exp_channel},${exp_power},${exp_essid},${exp_enc}" >> "${tmpdir}nws.txt"
					;;
					"WPA2")
						#Only WPA2 including WPA/WPA2 and WPA2/WPA3 in Mixed mode
						#Not used yet in airgeddon
						echo -e "${exp_mac},${exp_channel},${exp_power},${exp_essid},${exp_enc}" >> "${tmpdir}nws.txt"
					;;
					"WPA3")
						#Only WPA3 including WPA2/WPA3 in Mixed mode
						#Not used yet in airgeddon
						echo -e "${exp_mac},${exp_channel},${exp_power},${exp_essid},${exp_enc}" >> "${tmpdir}nws.txt"
					;;
					"WPA")
						#All, WPA, WPA2 and WPA3 including all Mixed modes
						if [[ -n "${2}" ]] && [[ "${2}" = "enterprise" ]]; then
							if [[ "${exp_auth}" =~ "MGT" ]]; then
								enterprise_network_counter=$((enterprise_network_counter + 1))
								echo -e "${exp_mac},${exp_channel},${exp_power},${exp_essid},${exp_enc}" >> "${tmpdir}nws.txt"
							fi
						else
							[[ ${exp_auth} =~ ^[[:blank:]](SAE)$ ]] && pure_wpa3="${BASH_REMATCH[1]}"
							if [ "${pure_wpa3}" != "SAE" ]; then
								echo -e "${exp_mac},${exp_channel},${exp_power},${exp_essid},${exp_enc}" >> "${tmpdir}nws.txt"
							fi
						fi
					;;
				esac
			else
				echo -e "${exp_mac},${exp_channel},${exp_power},${exp_essid},${exp_enc}" >> "${tmpdir}nws.txt"
			fi
		fi
	done < "${tmpdir}nws.csv"

	if [[ -n "${2}" ]] && [[ "${2}" = "enterprise" ]] && [[ "${enterprise_network_counter}" -eq 0 ]]; then
		#echo
		#language_strings "${language}" 612 "red"
		#language_strings "${language}" 115 "read"
		return 1
	fi

	sort -t "," -d -k 4 "${tmpdir}nws.txt" > "${tmpdir}wnws.txt"
}

explore_for_targets_option "WPA"