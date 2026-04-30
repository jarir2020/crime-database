import subprocess
import os

def run(cmd):
    try:
        result = subprocess.run(cmd, shell=True, capture_output=True, text=True)
        with open('debug_output.txt', 'w') as f:
            f.write(f"STDOUT:\n{result.stdout}\n")
            f.write(f"STDERR:\n{result.stderr}\n")
    except Exception as e:
        with open('debug_output.txt', 'w') as f:
            f.write(f"ERROR: {str(e)}\n")

os.chdir(r"d:\laragon\www\crime-database")
run("php artisan migrate --force")
