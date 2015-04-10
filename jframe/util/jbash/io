#!/bin/bash
# namespaced as: JBASH_IO_

JBASH_IO_echo () { JBASH_FORMAT_line $1; }
JBASH_IO_ok () { JBASH_FORMAT_cline "0;32" "[ok]    $1"; }
JBASH_IO_info () { JBASH_FORMAT_cline "0;35" "[info]  $1"; }
JBASH_IO_code () { JBASH_FORMAT_cline "0;36" "[code]  $1"; }
JBASH_IO_note () { JBASH_FORMAT_cline "0;34" "[note]  $1"; }
JBASH_IO_error () { JBASH_FORMAT_cline "0;31" "[error] $1"; }
JBASH_IO_fatal () { JBASH_FORMAT_cline "1;91" "[FATAL] $1"; JBASH_quit 1; }

JBASH_IO_ask () {
	JBASH_FORMAT_cnline "0;33" "$1: "
}

JBASH_IO_saidyes () {
	response=${1,,}
	if [ "$response" = "y" ] || [ "$response" = "yes" ]; then return 0; fi
	return 1
}

JBASH_IO_saidno () {
	response=${1,,}
	if [ "$response" = "n" ] || [ "$response" = "no" ]; then return 0; fi
	return 1
}
