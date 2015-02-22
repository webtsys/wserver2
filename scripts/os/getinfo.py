#!/usr/bin/python

import sys
import os
import platform
import json
import re
import argparse
import json
import configparser

pyv=platform.python_version_tuple()

if pyv[0]!='3':
	print('Need python 3 for execute this script')
	sys.exit(1)

parser = argparse.ArgumentParser(description='Obtain info about the server.')

parser.add_argument('--type', help='The type of server about you need info', required=True)
parser.add_argument('--os', help='The os of server', required=True)
parser.add_argument('--version', help='The version of os', required=True)

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
		
		"""print(json.dumps({'error': 'No exists the server type '+os.path.basename(path)}))
		
		sys.exit(1)"""
		pass
		
	#
	return arr_script

# Obtain Linux version

#distribution=platform.linux_distribution()

distribution=[args.os, args.version]

machine=platform.machine()

processor=platform.processor()

system=platform.system()

#Obtain scripts daemon
#Add the server type.

"""{
  "stooges": [
    { "name": "Moe" },
    { "name": "Larry" },
    { "name": "Curly" }
  ]
}"""

arr_version=distribution[1].split('.')

arr_version.append('')

version_final=[]

arr_config=[]

x=0

for num_version in arr_version:
	
	if num_version!='':
	
		version_final.append(num_version)
		
		num_version_final="/"+".".join(version_final)+"/"
	else:
		num_version_final="/"

	PATH_SEARCH=os.path.dirname(os.path.abspath(__file__))+'/'+distribution[0]+num_version_final+args.type
	#directory_search=''

	arr_script=[]

	arr_script=search_dir(PATH_SEARCH, arr_script)
	
	for cfg in arr_script:
		
		config = configparser.ConfigParser()
		
		config.read(cfg)
		
		arr_config.append({})
		
		for key in config['Description']:
			
			arr_config[x][key]=config['Description'][key]
		
		#check locked
		
		arr_config[x]['installed']=0
		
		locked_file=os.path.dirname(cfg)+'/installed'
		
		if os.path.isfile(locked_file):
			arr_config[x]['installed']=1
		
		x+=1	

#Load scripts for this type

print(json.dumps({'distribution': distribution, 'machine': machine, 'processor': processor, 'system': system, 'available_modules': arr_config}))



	