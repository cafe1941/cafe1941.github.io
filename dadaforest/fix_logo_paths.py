import os
import re

projects_dir = "/Users/blakelee/dawonx_dev/cafe1941.github.io/dadaforest/projects"

# Regex to find the logo img tag
logo_img_regex = re.compile(r'<img src="\.\./\.\./assets/DADA_logo\.svg" alt="DADA Forest">')

# Correct path: ../../../assets/DADA_logo.svg
new_logo_tag = '<img src="../../../assets/DADA_logo.svg" alt="DADA Forest">'

count = 0

for root, dirs, files in os.walk(projects_dir):
    for file in files:
        if file.endswith(".html"):
            path = os.path.join(root, file)
            with open(path, "r", encoding="utf-8") as f:
                content = f.read()

            if logo_img_regex.search(content):
                new_content = logo_img_regex.sub(new_logo_tag, content)
                with open(path, "w", encoding="utf-8") as f:
                    f.write(new_content)
                count += 1
                print(f"Fixed logo path in {file}")

print(f"Total fixed: {count}")
