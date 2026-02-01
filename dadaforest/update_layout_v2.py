import os
import re

projects_dir = "/Users/blakelee/dawonx_dev/cafe1941.github.io/dadaforest/projects"

# Regex to capture the current hero structure
# It looks for the container, image, overlay, and content
# <div class="project-hero-container">
#     <img src="..." alt="..." class="project-hero-img">
#     <div class="hero-overlay">
#         <div class="hero-content">
#             <span class="category">...</span>
#             <h1>...</h1>
#         </div>
#     </div>
# </div>

hero_regex = re.compile(
    r'<div class="project-hero-container">\s*<img src="([^"]+)" alt="([^"]+)" class="project-hero-img">\s*<div class="hero-overlay">\s*<div class="hero-content">\s*(.*?)\s*</div>\s*</div>\s*</div>',
    re.DOTALL
)

# New template: Image in container (for margins/panel link) but NO overlay. Content BELOW container.
# Or Content INSIDE container but below image?
# User said "Text padding ... align left/right".
# Let's put content BELOW the image container to be safe and style it separately.
# Actually, keeping it in the container might be easier for width control if the container has margins.
# Let's keep it simple: Container (Panel) -> Image + Content (Block).

new_hero_template = """<div class="project-hero-wrapper">
        <div class="project-hero-container">
            <img src="{src}" alt="{alt}" class="project-hero-img">
        </div>
        <div class="hero-content">
            {content}
        </div>
    </div>"""

count = 0

for root, dirs, files in os.walk(projects_dir):
    for file in files:
        if file.endswith(".html"):
            path = os.path.join(root, file)
            with open(path, "r", encoding="utf-8") as f:
                content = f.read()

            if hero_regex.search(content):
                def replace_hero(match):
                    src = match.group(1)
                    alt = match.group(2)
                    inner_content = match.group(3)
                    return new_hero_template.format(src=src, alt=alt, content=inner_content)

                new_content = hero_regex.sub(replace_hero, content)

                with open(path, "w", encoding="utf-8") as f:
                    f.write(new_content)
                
                print(f"Updated layout in {file}")
                count += 1
            else:
                print(f"Hero pattern not found in {file}")

print(f"Total updated: {count}")
