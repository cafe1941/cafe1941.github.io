import os
import re

# List of files identified as "restored" with synthetic text
target_files = [
    "hahouse.html",
    "leehouse1.html",
    "leehouse2.html",
    "gwanggyo.html",
    "bgd.html",
    "scj.html",
    "leeresidence.html",
    "frtek.html",
    "sonhouse.html",
    "parkhouse.html",
    "hsj.html",
    "museumpark.html",
    "nongwoo.html"
]

projects_dir = "/Users/blakelee/dawonx_dev/cafe1941.github.io/dadaforest/projects"

# Regex to find the paragraph content
# <div class="detail-section">
#     <p>...</p>
# </div>
# OR just <p>...</p> inside .detail-section from our last update.

# Our last update structure:
# <section class="project-detail">
#    <div class="detail-section">
#        <p>{description}</p>
#    </div>
# </section>

p_regex = re.compile(r'<div class="detail-section">\s*<p>(.*?)</p>\s*</div>', re.DOTALL)

count = 0

for root, dirs, files in os.walk(projects_dir):
    for file in files:
        if file in target_files:
            path = os.path.join(root, file)
            with open(path, "r", encoding="utf-8") as f:
                content = f.read()

            # Replace with empty p tag or placeholder "Coming Soon" if clearer?
            # User said: "비워놓는게 좋을 것 같아" (Leave it empty)
            new_content = p_regex.sub('<div class="detail-section">\n                        <p></p>\n                    </div>', content)

            if new_content != content:
                with open(path, "w", encoding="utf-8") as f:
                    f.write(new_content)
                print(f"Cleared description in {file}")
                count += 1
            else:
                print(f"No description match found in {file}")

print(f"Total entries cleared: {count}")
