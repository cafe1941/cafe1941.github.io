import os
import re

projects_dir = "/Users/blakelee/dawonx_dev/cafe1941.github.io/dadaforest/projects"

# Regex to find the div class logo
logo_regex = re.compile(
    r'<div class="logo">\s*<img src="([^"]+)" alt="([^"]+)">\s*</div>',
    re.DOTALL
)

# New template
new_logo_template = """<a href="../../index.html" class="logo">
            <img src="{src}" alt="{alt}">
        </a>"""

count = 0

for root, dirs, files in os.walk(projects_dir):
    for file in files:
        if file.endswith(".html"):
            path = os.path.join(root, file)
            with open(path, "r", encoding="utf-8") as f:
                content = f.read()

            if logo_regex.search(content):
                def replace_logo(match):
                    src = match.group(1)
                    alt = match.group(2)
                    return new_logo_template.format(src=src, alt=alt)

                new_content = logo_regex.sub(replace_logo, content)

                with open(path, "w", encoding="utf-8") as f:
                    f.write(new_content)
                
                print(f"Updated logo in {file}")
                count += 1
            else:
                print(f"Logo pattern not found in {file}")

print(f"Total updated: {count}")
