import subprocess
import os

def run(cmd):
    print(f"Running: {cmd}")
    try:
        result = subprocess.run(cmd, shell=True, capture_output=True, text=True, check=True)
        print("STDOUT:", result.stdout)
        print("STDERR:", result.stderr)
    except subprocess.CalledProcessError as e:
        print("FAILED:", e)
        print("STDOUT:", e.stdout)
        print("STDERR:", e.stderr)

os.chdir(r"d:\laragon\www\crime-database")
run("git status")
run("git add Dockerfile")
run("git commit -m \"Fix Docker build: Add missing dependencies and clean up PHP extensions\"")
run("git push origin main")
