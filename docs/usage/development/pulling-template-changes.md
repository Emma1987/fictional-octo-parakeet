# Pulling the template's newest changes in your project

If the project template has had notable updates that you would like to benefit
from, here's how you can pull these changes in your existing project.

Before you start, make sure your project is tracked with Git and that you
don't have any uncommited or unstashed changes.

Then, follow these steps:

1. Clone the template into a new directory outside of your project: 
   ```bash
   git clone https://github.com/eckinox/symfony-docker-template.git .
   ```
2. Remove the `.git` directory: 
   ```bash
   rm -rf .git
   ```
3. Copy all files from the template into your project's directory: 
   ```bash
   cp -R . /your/project/dir/
   ```
4. In your project, check all of the files that have been modified or deleted
   to ensure that none of your project's changes are being undone.
   - Use `git status` to view all files that have been added/changed/deleted;
   - Use `git diff` or your IDE's diff feature to see a file's changes.
5. Test your project to ensure everything works as expected. 
   - You should review any changes in documentation to learn about breaking 
     changes that will require you to change something in your project.
6. Once everything works, stage everything (`git add --a`) and commit the 
   changes.
