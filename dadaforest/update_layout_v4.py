import os
import re

projects_dir = "/Users/blakelee/dawonx_dev/cafe1941.github.io/dadaforest/projects"

# Current structure from v3:
# <main>
#   <div class="project-content-wrapper">
#       <div class="project-hero-container"> (Image) </div>
#       <div class="project-meta-grid">
#           <div class="hero-content"> (Title) </div>
#           <section class="project-detail"> (Desc) </section>
#       </div>
#   </div>
# </main>

# Regex to capture content components
content_regex = re.compile(
    r'<main>\s*<div class="project-content-wrapper">\s*<div class="project-hero-container">\s*<img src="([^"]+)" alt="([^"]+)" class="project-hero-img">\s*</div>\s*<div class="project-meta-grid">\s*<div class="hero-content">\s*<span class="category">([^<]+)</span>\s*<h1>([^<]+)</h1>\s*</div>\s*<section class="project-detail">\s*<div class="detail-section">\s*<p>(.*?)</p>\s*</div>\s*</section>\s*</div>\s*</div>\s*</main>',
    re.DOTALL
)

# New Template: Title -> Image -> Description
new_main_template = """<main>
        <div class="project-content-wrapper">
            <!-- 1. Header: Title & Category -->
            <div class="project-header">
                <span class="category">{category}</span>
                <h1>{title}</h1>
            </div>

            <!-- 2. Full Image (Natural Ratio) -->
            <div class="project-image-panel">
                <img src="{src}" alt="{alt}" class="project-full-img">
            </div>
            
            <!-- 3. Description -->
            <section class="project-detail-bottom">
                <div class="detail-text">
                    <p>{description}</p>
                </div>
            </section>
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
                
                print(f"Reordered to Title-First layout in {file}")
                count += 1
            else:
                print(f"Pattern not found in {file}")

print(f"Total updated: {count}")
