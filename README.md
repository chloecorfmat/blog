# Blog of Chloé Corfmat with WordPress
This project was developed by Chloé Corfmat.

## Tech Stack
WordPress CMS

## Deploy in production
`ansible-playbook wp-build.yml -i inventories/prod.yml -e "tag=main" --ask-pass --ask-become-pass`
`ansible-playbook wp-deploy.yml -i inventories/prod.yml -e "tag=main" --ask-pass --ask-become-pass`

## Authors
- [@chloecorfmat](https://www.github.com/chloecorfmat)

## Used By
This project is only used by Chloé Corfmat.