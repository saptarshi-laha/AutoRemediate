import platform
import sys
import json
import requests
import yara
import base64
from Crypto.Cipher import AES


def delete_keys():
    x = 1


def delete_service():
    x = 2


def delete_files():
    x = 3


def uninstall_program():
    x = 4


def retrieve_list(operating_system, key):
    # Retrieves OS specific general remediation JSON.
    remediation_list = requests.get("https://google.com/", data=operating_system, cookies=key)
    return remediation_list


def parse_json(list_json):
    # Parses JSON to identify individual tasks and perform them.
    for i in list_json:
        i.find(1)


unique_key = "client_key"

if len(sys.argv) == 1:
    # Used to remediate general malware/adware.
    system_name = platform.system()  # Check the system for system specific remediation.

    if system_name == "Darwin":
        # MacOS
        json_list = retrieve_list(system_name, unique_key)
        parse_json(json_list)

    elif system_name == "Linux":
        # Linux
        json_list = retrieve_list(system_name, unique_key)
        parse_json(json_list)

    elif system_name == "Windows":
        # Windows
        json_list = retrieve_list(system_name, unique_key)
        parse_json(json_list)


elif len(sys.argv) == 3:
    # Used to remediate a specific malware/adware variant.
    print(4)
