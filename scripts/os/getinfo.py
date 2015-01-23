#!/usr/bin/python

import sys
import os
import platform
import json
import re
import argparse

pyv=platform.python_version_tuple()

if pyv[0]!='3':
	print('Need python 3 for execute this script')
	sys.exit(1)
	
import configparser


parser = argparse.ArgumentParser(description='Obtain info about the server.')

parser.add_argument('--type', help='The type of server about you need info', required=True)

args = parser.parse_args()

#Function for search cfg files

def search_dir(path, arr_script=[]):
	
	prog = re.compile("^(.*).cfg$")
	
	try:
	
		for file in os.listdir(path):
			
			if os.path.isdir(path+'/'+file):
				
				arr_script=search_dir(path+'/'+file, arr_script)
				
			elif prog.match(file):
				
				arr_script.append(path+'/'+file)
	except OSError:
		
		print({'error': 'No exists the server type '+path})
		
		sys.exit(1)
		
	#
	return arr_script

# Obtain Linux version

distribution=platform.linux_distribution()

machine=platform.machine()

processor=platform.processor()

system=platform.system()

#Obtain scripts daemon
#Add the server type.

PATH_SEARCH=os.path.dirname(os.path.abspath(__file__))+'/'+distribution[0]+'/'+args.type

#print(PATH_SEARCH)
#directory_search=''

arr_config={}

arr_script=search_dir(PATH_SEARCH)

for cfg in arr_script:
	
	config = configparser.ConfigParser()
	
	config.read(cfg)
	
	arr_config[config['Description']['basename']]={}
	
	for key in config['Description']:
		
		arr_config[config['Description']['basename']][key]=config['Description'][key]
		

#Load scripts for this type

print({'distribution': distribution, 'machine': machine, 'processor': processor, 'system': system, 'available_modules': arr_config})



	