import os
import re

projects_dir = "/Users/blakelee/dawonx_dev/cafe1941.github.io/dadaforest/projects"

# Regex to find the wrapper we created in previous step
# It looks for <div class="project-hero-wrapper"> ... </div>
# Inside it has .project-hero-container (img) and .hero-content (title)
# We need to restructure it to:
# .project-content-wrapper
#   -> .project-hero-container (Img)
#   -> .project-meta-grid (Wrapper for text)
#       -> .hero-content (Left)
#       -> .project-detail (Right - moved from outside!)

# Step 1: Find the entire main content to rewrite it flexibly.
# The structure is currently:
# <main>
#    <div class="project-hero-wrapper">...</div>
#    <section class="project-detail">...</section>
# </main>

# Regex to capture the Image Src, Title, Category, and Description
content_regex = re.compile(
    r'<main>\s*<div class="project-hero-wrapper">\s*<div class="project-hero-container">\s*<img src="([^"]+)" alt="([^"]+)" class="project-hero-img">\s*</div>\s*<div class="hero-content">\s*<span class="category">([^<]+)</span>\s*<h1>([^<]+)</h1>\s*</div>\s*</div>\s*<section class="project-detail">\s*<div class="detail-section">\s*<h2>Project Description</h2>\s*<p>(.*?)</p>\s*</div>\s*</section>\s*</main>',
    re.DOTALL
)

# New Template
new_main_template = """<main>
        <div class="project-content-wrapper">
            <div class="project-hero-container">
                <img src="{src}" alt="{alt}" class="project-hero-img">
            </div>
            
            <div class="project-meta-grid">
                <div class="hero-content">
                    <span class="category">{category}</span>
                    <h1>{title}</h1>
                </div>
                
                <section class="project-detail">
                    <div class="detail-section">
                        <p>{description}</p>
                    </div>
                </section>
            </div>
        </div>
    </main>"""

count = 0

for root, dirs, files in os.walk(projects_dir):
    for file in files:
        if file.endswith(".html"):
            path = os.path.join(root, file)
            with open(path, "r", encoding="utf-8") as f:
                content = f.read()

            if content_regex.search(content):
                def replace_layout(match):
                    src = match.group(1)
                    alt = match.group(2)
                    category = match.group(3)
                    title = match.group(4)
                    description = match.group(5)
                    return new_main_template.format(
                        src=src, 
                        alt=alt, 
                        category=category, 
                        title=title, 
                        description=description
                    )

                new_content = content_regex.sub(replace_layout, content)

                with open(path, "w", encoding="utf-8") as f:
                    f.write(new_content)
                
                print(f"Refactored grid layout in {file}")
                count += 1
            else:
                print(f"Pattern not found in {file} - may need manual check")

print(f"Total updated: {count}")
