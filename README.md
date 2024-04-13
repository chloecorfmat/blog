# Blog of Chloé Corfmat with WordPress
This project was developed by Chloé Corfmat.

## Tech Stack
WordPress CMS

## Deploy in production
`ansible-playbook wp-build.yml -i inventories/prod.yml -e "tag=main" --ask-pass --ask-become-pass`

`ansible-playbook wp-deploy.yml -i inventories/prod.yml -e "tag=main" --ask-pass --ask-become-pass`

## Install in dev environment
1. Launch these commands : 
```
cd chloecorfmat
docker compose up -d
```

2. Install these plugins in `/wp-admin/plugins.php` :
    * Advanced Custom Fields PRO
    * Advanced Custom Fields: Font Awesome
    * Redirection

3. Paramétrer la page d'accueil et de blog

4. Paramétrer les permaliens

## Authors
- [@chloecorfmat](https://www.github.com/chloecorfmat)

## Used By
This project is only used by Chloé Corfmat.