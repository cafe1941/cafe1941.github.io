import os
import re

projects_dir = "/Users/blakelee/dawonx_dev/cafe1941.github.io/dadaforest/projects"

# Regex to capture the hero section with background image
hero_regex = re.compile(
    r'<section class="project-hero" style="background-image: url\(\'([^\']+)\'\)">\s*<div class="hero-content">\s*<span class="category">([^<]+)</span>\s*<h1>([^<]+)</h1>\s*</div>\s*</section>',
    re.DOTALL
)

# New template for the hero section
new_hero_template = """
    <div class="project-hero-container">
        <img src="{img_path}" alt="{title}" class="project-hero-img">
        <div class="hero-overlay">
            <div class="hero-content">
                <span class="category">{category}</span>
                <h1>{title}</h1>
            </div>
        </div>
    </div>
"""

count = 0

for root, dirs, files in os.walk(projects_dir):
    for file in files:
        if file.endswith(".html"):
            path = os.path.join(root, file)
            with open(path, "r", encoding="utf-8") as f:
                content = f.read()

            match = hero_regex.search(content)
            if match:
                img_path = match.group(1)
                category = match.group(2)
                title = match.group(3)

                new_hero = new_hero_template.format(
                    img_path=img_path,
                    category=category,
                    title=title
                )

                new_content = hero_regex.sub(new_hero, content)

                with open(path, "w", encoding="utf-8") as f:
                    f.write(new_content)
                
                print(f"Updated {file}")
                count += 1
            else:
                print(f"Skipping {file} (no match)")

print(f"Total updated: {count}")
