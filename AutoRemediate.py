import platform
import sys
import json
import requests
import yara
import base64
from Crypto.Cipher import AES


class WindowsCommands:
    def delete_keys():
        x = 1

    def delete_service():
        x = 2

    def delete_files():
        x = 3

    def uninstall_program():
        x = 4


class GetAndParseData:
    def __init__(self, key):
        # Retrieve Operating System for the client Environment
        self.operating_system = platform.system()
        # Set the Client Key for retrieving the Payload
        self.client_key = key

        if self.operating_system == "Darwin":
            # Get encrypted Darwin Rule List
            encrypted_list = GetAndParseData.retrieve_list(self.operating_system, self.key)

        elif self.operating_system == "Linux":
            # Get encrypted Linux Rule List
            encrypted_list = GetAndParseData.retrieve_list(self.operating_system, self.key)

        elif self.operating_system == "Windows":
            # Get encrypted Windows Rule List
            encrypted_list = GetAndParseData.retrieve_list(self.operating_system, self.key)

        #Save Encrypted List to File
        #to be done.
        # Get Decrypted JSON List
        json_list = GetAndParseData.aes_decrypt(encrypted_list)
        # Parse JSON Data for Rules
        GetAndParseData.parse_json(json_list)

    @staticmethod
    def save_to_file(list_encrypted):
        f = open("demofile3.txt", "w")
        f.write("Woops! I have deleted the content!")
        f.close()

    @staticmethod
    def retrieve_list(operating_system, key):
        # Retrieves OS specific general remediation JSON.
        remediation_list = requests.get("https://google.com/", data=operating_system, cookies=key)
        return remediation_list

    @staticmethod
    def parse_json(list_json):
        # Parses JSON to identify individual tasks and perform them.
        for i in list_json:
            i.find(1)

    @staticmethod
    def aes_decrypt(list_encrypted):
        list_json = base64.b64decode(list_encrypted)
        #Perform AES Decryption operations here using client key

        return list_json


unique_key = "client_key"

if len(sys.argv) == 3:
    # Used to remediate a specific malware/adware variant.
    print(4)
else:
    GetAndParseData(unique_key)
