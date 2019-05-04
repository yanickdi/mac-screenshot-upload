#!/usr/bin/env python3

import os
import subprocess
import tempfile
from datetime import datetime

def upload_file(filename, url):
    completed_proc = subprocess.run(['curl', '-F', f'file=@{filename}', url])
    print(completed_proc.stdout)

def main():
    datestr = datetime.now().strftime('%Y-%m-%d_%H_%M_%S')
    folder = tempfile.gettempdir()
    fname = os.path.join(folder, datestr + '.png')
    ret_code = subprocess.Popen(['screencapture', '-i', fname]).wait()
    # upload
    upload_file(fname, 'http://localhost:8080/upload.php')


if __name__ == '__main__':
    main()
