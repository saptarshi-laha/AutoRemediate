import platform
import sys
import json
import requests
import yara
import base64
import psutil
import hashlib

class WindowsCommands:
    @staticmethod
    def delete_keys():
        x = 1

    @staticmethod
    def delete_service():
        x = 2

    @staticmethod
    def delete_files():
        x = 3

    @staticmethod
    def uninstall_program():
        x = 4


class LinuxCommands:
    @staticmethod
    def delete_keys():
        x = 1

    @staticmethod
    def delete_service():
        x = 2

    @staticmethod
    def delete_files():
        x = 3

    @staticmethod
    def uninstall_program():
        x = 4


class DarwinCommands:
    @staticmethod
    def delete_keys():
        x = 1

    @staticmethod
    def delete_service():
        x = 2

    @staticmethod
    def delete_files():
        x = 3

    @staticmethod
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
            encrypted_list = GetAndParseData.retrieve_list(self.operating_system, self.client_key)

        elif self.operating_system == "Linux":
            # Get encrypted Linux Rule List
            encrypted_list = GetAndParseData.retrieve_list(self.operating_system, self.client_key)

        elif self.operating_system == "Windows":
            # Get encrypted Windows Rule List
            encrypted_list = GetAndParseData.retrieve_list(self.operating_system, self.client_key)

        # Save Encrypted List to File - ideally not.
        # to be done.
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
        # Set Fail Variable to 0
        trial = 0
        try:
            # Retrieves OS specific general remediation JSON.
            remediation_list = requests.get("http://localhost:8888/getSystemList.php", params={"platform": operating_system})
            # Try Parsing Correct Data
            correct_content = remediation_list.content.decode("utf-8").startswith("eSentire")
            # Remediation List doesn't Start with eSentire
            if correct_content is False:
                # Set Failure Condition to 1
                trial = 1
                # Failure to Parse Correct Data
                print("Error parsing file contents. Please try again.")
        except:
            # Failure to Get Data
            print("Error gathering file contents. Please try again.")
            # Set Failure Condition to 1
            trial = 1
        finally:
            # If Failed to Get Data
            if trial == 1:
                # Exit Program
                exit(0)
        # If Parsed Data is Correct, Proceed with the Next Steps
        return remediation_list.content.decode("utf-8")[8:]

    @staticmethod
    def parse_json(list_json):
        # Parses JSON to identify individual tasks and perform them.
        return 0

    @staticmethod
    def aes_decrypt(list_encrypted):
        list_json = base64.b64decode(list_encrypted).decode('utf-8')
        # Perform AES Decryption operations here using client key
        print(list_json)
        return list_json


unique_key = "client_key"

if len(sys.argv) == 3:
    # Used to Remediate a Specific Malware/Adware Variant
    print(4)
elif len(sys.argv) == 2:
    # Used to Remediate All Malware based on Full List
    GetAndParseData(unique_key)
else:
    # Non-predefined number of arguments
    print("Unknown Argument Format!")
    # Exit Program
    exit(0)