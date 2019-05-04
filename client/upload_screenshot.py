#!/usr/bin/env python3

import os
import sys
from subprocess import check_output
import tempfile
from datetime import datetime
import json


def copy2clip(txt):
    cmd='echo '+txt.strip()+' | pbcopy'
    return check_output(cmd, shell=True)


def upload_file(filename, url, key):
    curl = check_output(['curl', '-s', '-F', f'file=@{filename}', '--header', f'X-Key: {key}', url])
    url = curl.decode('utf-8')
    print(url)
    copy2clip(url)


def main():
    settings = json.load(open('.settings.json'))

    date_str = datetime.now().strftime('%Y-%m-%d_%H_%M_%S')
    folder = tempfile.gettempdir()
    fname = os.path.join(folder, date_str + '.png')
    check_output(['screencapture', '-i', fname])
    # upload
    upload_file(fname, settings['url'], settings['key'])


if __name__ == '__main__':
    main()
